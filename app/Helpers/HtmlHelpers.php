<?php
if(!function_exists('ticket_number'))
{
	function ticket_number()
	{
    // 17-01-00030 ปี-เดือน-ลำดับ
    $year = date("y");
    $month = date("m");

    // $tickets = 170400030;
    $rs = DB::table('tickets')->whereNotNull('subj_ticket_number')->orderBy('subj_ticket_number','desc')->first();
	$tickets = $rs->subj_ticket_number;

    $year = date("y");
    $month = date("m");

    if (preg_match('/^\d{9}$/', $tickets)) {

        $dbYear = substr($tickets,0,2);
        $dbMonth = substr($tickets,2,2);
        $dbOrder = substr($tickets,4);

        if($year == $dbYear){
            $order = $dbOrder + 1;
        }elseif($year > $dbYear){
            $order = 1;
        }

        $ticket_number = $year.$month.sprintf("%05d", $order);

    } else {

        $order = 1;
        $ticket_number = $year.$month.sprintf("%05d", $order);

    }

    return $ticket_number;
	}
}

if(!function_exists('ticket_number_format'))
{
	function ticket_number_format($ticket_number)
	{
    // $ticket_number = "170400001";

    $result = substr_replace($ticket_number, "-", 2, 0);
    $result = substr_replace($result, "-", 5, 0);

    return $result;
	}
}

if(!function_exists('find_ticket_id'))
{
	function find_ticket_id($ticket_number)
	{
    $rs = DB::table('tickets')->where('subj_ticket_number',$ticket_number)->first();
    return @$rs->id;
	}
}

if(!function_exists('permission'))
{
	function permission($module=false)
	{
		$rs = App\Models\Permissions::where('module',$module)
							->WhereHas('permission_roles',function($q){
								$q->where('permission_groups_id',Auth::user()->permission_groups_id)
								->whereNull('deleted_at');
							})
							->first();
    return @$rs->id != '' ? true : false ;
	}
}

if(!function_exists('ticket_auto_status'))
{
	function ticket_auto_status($ticket_id=false,$cable_type=false)
	{
		$rs = App\Models\Tickets::find($ticket_id);

			## เหตุการณ์ที่ทำให้เปลี่ยนสถานะ ##
			# 1. สถานะรอรับแจ้งผู้รับผิดชอบ :: ต้องยังไม่มีข้อมูลแผนการช่วยเหลือ (tab2)
			$e1 = $rs->plan()->count();
			if($e1 == 0){
				// echo 'สถานะรอรับแจ้งผู้รับผิดชอบ';
				$rs->ticket_statuses_id = 1;
			}else{

				# 2. สถานะพิจารณาการช่วยเหลือ :: มีข้อมูลแผนการช่วยเหลือแล้ว แตยัง่ไม่ checkbox วา่งแผนความช่วยเหลือเรียบร้อย
				$e2 = $rs->plan()->where('status',1)->count();
				if($e2 == 0){

					# 3. สถานะส่งต่อพื้นที่ :: มีข้อมูลแผนการช่วยเหลือแล้ว แตยัง่ไม่ checkbox วางแผนความช่วยเหลือเรียบร้อย และมี ข้อมูลหน่วยงานที่ส่งต่อ
					$e3 = $rs->plan()->where('status',0)->has('coodinate')->count();
					if($e3 == 0){
						// echo 'สถานะพิจารณาการช่วยเหลือ';
						$rs->ticket_statuses_id = 2;
					}else{
						// echo 'สถานะส่งต่อพื้นที่';
						$rs->ticket_statuses_id = 3;
					}
				}else{

					# 4. สถานะรายงานการช่วยเหลือ :: แผนการช่วยเหลือมี checkbox วางแผนความช่วยเหลือเรียบร้อยแล้ว แต่ผลการช่วยเหลือยังไม่ checkox ว่าให้ความช่วยเหลือเรียบร้อย
					$e4 = $rs->result()->where('status',1)->count();
					if($e4 == 0){
						// echo 'สถานะรายงานการช่วยเหลือ';
						$rs->ticket_statuses_id = 4;
					}else{

						if($rs->conclude_notify_date == ''){
							# 5. สถานะช่วยเหลือเรียบร้อย :: ผลการช่วยเหลือมี checkbox ให้ความช่วยเหลือเรียบร้อย
							// echo 'สถานะช่วยเหลือเรียบร้อย';
							$rs->ticket_statuses_id = 5;
						}else{
							# 6. สถานะปัญหายุติแล้ว :: tab สรุปยุติปัญหา มีข้อมูลแจ้งปัญหายุติวันที่
							// echo 'สถานะปัญหายุติแล้ว';
							$rs->ticket_statuses_id = 6;
						}
					}
				}
			}

			// ถ้าประเภทสายเป็น ติดตามปัญหาเดิม, โทรผิด, ก่อกวน, สอบถามข้อมูล, ให้ข้อคิดเห็น, (999 คือ ยุติปัญหาที่แท็บแผนความช่วยเหลือ) ให้ปิดเคส (ปัญหายุติแล้ว)
			if( in_array(@$cable_type, array(2, 3, 5, 6, 7, 999)) ){
				$rs->ticket_statuses_id = 6;
			}

		$rs->save();
	}
}

if(!function_exists('check_reference'))
{
	function check_reference($module,$id)
	{
		if($module == 'user'){
			$rs = App\Models\Tickets::where('notify_users_id',$id)
						->orWhere('conclude_users_id', $id)
						->orWhereHas('plan', function($q) use($id){
							 $q->where('users_id', $id)
							 ->orWhereHas('almoner', function($r) use($id){
								 	$r->where('users_id', $id);
							 });
						})
						->orWhereHas('result', function($s) use($id){
							$s->where('users_id', $id);
						})
						->first();

		}

		if($module == 'permission'){
			$rs = App\Models\Users::where('permission_groups_id',$id)->first();
		}

		if($module == 'target'){
			$rs = App\Models\Targets::where('parent_id',$id)->first();
		}

		if($module == 'department'){
			$rs = App\Models\Departments::where('parent_id',$id)->first();
		}

		if($module == 'dept_out'){
			$rs = App\Models\Ticket_plan_coodinate::where('dept_outs_id',$id)->first();
		}

		if($module == 'dept_out_type'){
			$rs = App\Models\Dept_outs::where('dept_out_types_id',$id)->first();
		}

		if($module == 'country'){
			$rs = App\Models\Provinces::where('countries_id',$id)->first();
		}

		if($module == 'province'){
			$rs = App\Models\Amphoes::where('provinces_id',$id)->first();
		}

		if($module == 'amphoe'){
			$rs = App\Models\Tumbons::where('amphoes_id',$id)->first();
		}

		if($module == 'tumbon'){
			$rs = App\Models\Tickets::where('notify_tumbons_id',$id)
						->orWhere('event_tumbons_id',$id)
						->orWhereHas('receives', function($q) use($id){
							 $q->where('reg_tumbons_id', $id)
							 ->orWhere('now_tumbons_id', $id);
						})
						->orWhereHas('offender', function($q) use($id){
							 $q->where('reg_tumbons_id', $id)
							 ->orWhere('now_tumbons_id', $id);
						})
						->first();
		}

		if($module == 'prefix'){
			$rs = App\Models\Tickets::where('notify_prefixs_id',$id)
						->orWhereHas('receives', function($q) use($id){
							 $q->where('info_prefixs_id', $id)
							 ->orWhere('family_f_prefixs_id', $id)
							 ->orWhere('family_m_prefixs_id', $id);
						})
						->orWhereHas('offender', function($q) use($id){
							 $q->where('info_prefixs_id', $id);
						})
						->first();
		}

		if($module == 'gender'){
			$rs = App\Models\Tickets::whereHas('receives', function($q) use($id){
							 $q->where('info_genders_id', $id);
						})
						->orwherehas('offender', function($q) use($id){
							 $q->where('info_genders_id', $id);
						})
						->first();
		}

		if($module == 'religion'){
			$rs = App\Models\Tickets::whereHas('receives', function($q) use($id){
							 $q->where('info_religions_id', $id);
						})
						->orwherehas('offender', function($q) use($id){
							 $q->where('info_religions_id', $id);
						})
						->first();
		}

		if($module == 'nationality'){
			$rs = App\Models\Tickets::whereHas('receives', function($q) use($id){
							 $q->where('info_nationalities_id', $id);
						})
						->orwherehas('offender', function($q) use($id){
							 $q->where('info_nationalities_id', $id);
						})
						->first();
		}

		if($module == 'race'){
			$rs = App\Models\Tickets::whereHas('receives', function($q) use($id){
							 $q->where('info_races_id', $id);
						})
						->orwherehas('offender', function($q) use($id){
							 $q->where('info_races_id', $id);
						})
						->first();
		}

		if($module == 'channel_know'){
			$rs = App\Models\Tickets::where('notify_channel_knows_id',$id)->first();
		}

		if($module == 'channel'){
			$rs = App\Models\Tickets::where('notify_channels_id',$id)->first();
		}

		if($module == 'dept_info'){
			$rs = App\Models\Tickets::where('notify_dept_infos_id',$id)->first();
		}

		if($module == 'career'){
			$rs = App\Models\Tickets::whereHas('receives', function($q) use($id){
							 $q->where('info_careers_id', $id);
						})
						->orwherehas('offender', function($q) use($id){
							 $q->where('info_careers_id', $id);
						})
						->first();
		}

		if($module == 'marital_status'){
			$rs = App\Models\Tickets::whereHas('receives', function($q) use($id){
							 $q->where('info_marital_statuses_id', $id);
						})
						->orwherehas('offender', function($q) use($id){
							 $q->where('info_marital_statuses_id', $id);
						})
						->first();
		}

		if($module == 'cable_type'){
			$rs = App\Models\Tickets::where('notify_cable_types_id',$id)->first();
		}

		if($module == 'category_info'){
			$rs = App\Models\Tickets::where('notify_category_infos_id',$id)->first();
		}

		if($module == 'urgent'){
			$rs = App\Models\Ticket_plan::where('urgents_id',$id)->first();
		}

		if($module == 'doc_type'){
			$rs = App\Models\Ticket_attach::where('doc_types_id',$id)->first();
		}

		if($module == 'position'){
			$rs = App\Models\Users::where('positions_id',$id)->first();
		}

		if($module == 'risk'){
			$rs = App\Models\Tickets::where('risks_id',$id)->first();
		}

		if($module == 'help'){
			$rs = App\Models\Ticket_plan_help::where('helps_id',$id)->first();
		}

		if($module == 'vex'){
			$rs = App\Models\Tickets::where('vex_id',$id)->first();
		}

		// true = ไม่มี reference , false = มี reference
		return is_null($rs) ? true : false ;
	}
}

if(!function_exists('ticket_notify'))
{
	function ticket_notify()
	{
		// จำนวนงานที่ถูกเปิดในรอบเวรที่ผ่านมา xx เคส (คำนวณจาก 12 ชม.ที่ผ่านมามีกี่เคสที่ถูกสร้างขึ้นใหม่)
		$rs = App\Models\Tickets::whereDate('created_at', '>=', Carbon::now()->subHour(12))->whereNotNull('subj_ticket_number')->count();

		// จำนวนงานค้างที่เจ้าหน้าที่ต้องดำเนินการ xx เคส (คำนวณจากเคสทั้งหมดที่ไม่ใช่สถานะปัญหายุติแล้ว)
		$rs2 = App\Models\Tickets::where('ticket_statuses_id','<>',6)->whereNotNull('subj_ticket_number')->count();

    return '<div class="alert alert-info"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Info!</strong> จำนวนงานที่ถูกเปิดในรอบเวรที่ผ่านมา <strong>'.$rs.'</strong> เคส, จำนวนงานค้างที่เจ้าหน้าที่ต้องดำเนินการ <strong>'.$rs2.'</strong> เคส</div>' ;
	}
}

if(!function_exists('bookforward_chk'))
{
	function bookforward_chk($ticket_id,$ticket_plan_id,$ticket_plan_coodinate_id)
	{
		$rs = App\Models\Bookforwards::where('ticket_id',$ticket_id)
																	->where('ticket_plan_id',$ticket_plan_id)
																	->where('ticket_plan_coodinate_id',$ticket_plan_coodinate_id)
																	->where('forward_status',2)
																	->first();
		if ($rs != null) {
			 return '<span style="color:#eaa70a;">(ประสานส่งเรียบร้อยแล้ว)</span>';
		}
	}
}

if(!function_exists('smCard2Datepicker'))
{
	function smCard2Datepicker($thDate)
	{
		$thai_month_arr=array(
		    "มกราคม"=>"01",
		    "กุมภาพันธ์"=>"02",
		    "มีนาคม"=>"03",
		    "เมษายน"=>"04",
		    "พฤษภาคม"=>"05",
		    "มิถุนายน"=>"06",
		    "กรกฎาคม"=>"07",
		    "สิงหาคม"=>"08",
		    "กันยายน"=>"09",
		    "ตุลาคม"=>"10",
		    "พฤศจิกายน"=>"11",
		    "ธันวาคม"=>"12"
		);

		// $thDate = 14 สิงหาคม 2527
		$arrayDate = explode(" ",$thDate);
		$newDate = $arrayDate[0].'/'.$thai_month_arr[$arrayDate[1]].'/'.$arrayDate[2];
		return $newDate;
	}
}
