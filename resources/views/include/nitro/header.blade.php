<aside id="fh5co-aside" role="complementary" class="border js-fullheight">

    <h1 id="fh5co-logo"><a href="http://line.me/ti/p/~ratasak1234" target="_blank"><img class="img-fluid" width="115" height="115" src="https://linesticker.in.th/image/qr_ratasak1234.png" alt="ขายสติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ ของแท้ ไม่มีหาย"></a></h1>
    <nav id="fh5co-main-menu" role="navigation">
        <ul>
            <li class="fh5co-active"><a href="home">หน้าแรก</a></li>
            <li><a href="{{ url('sticker') }}">สติ๊กเกอร์ไลน์ครีเอเตอร์</a></li>
            <li><a href="{{ url('emoji') }}">อิโมจิครีเอเตอร์</a></li>
            <li><a href="{{ url('theme') }}">ธีมไลน์ครีเอเตอร์</a></li>
            <!-- <li><a href="{{ url('page/11') }}">ฝากซื้อ</a></li>
            <li><a href="{{ url('page/10') }}">ฝากขาย</a></li> -->
            <li><a href="{{ url('aboutus') }}">เกี่ยวกับเรา</a></li>
            <!-- <li><a href="{{ url('search') }}">ค้นหา</a></li> -->

            <hr>

            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">เข้าสู่ระบบ</a></li>
                <li><a href="{{ url('/register') }}">สมัครสมาชิก</a></li>
            @else
                <li><a href="{{ url('/creator/dashboard') }}">จัดการข้อมูล</a></li>
                <li><a href="{{ url('/logout') }}">ออกจากระบบ</a></li>
            @endif

            <hr>

        </ul>
    </nav>

    <!-- <form class="bd-search d-flex align-items-center" method="get" action="{{ url('search') }}">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" placeholder="ค้นหา" name="q" value="{{ @$_GET['q'] }}">
            <div class="input-group-append">
                <button class="btn btn-sm btn-outline-secondary" type="submit" id="button-addon2"><i class="icon-search"></i></button>
            </div>
        </div>
    </form> -->

    <div class="fh5co-footer">
        <p>
            linepop.in.th เว็บไซต์ที่ให้บริการโปรโมท สติ๊กเกอร์ไลน์ อิโมจิไลน์ ธีมไลน์ฟรี ไม่มีค่าใช้จ่าย สำหรับครีเอเตอร์ทุกท่าน สอบถามข้อมูลเพิ่มเติมติดต่อไลน์ไอดี <a href="http://line.me/ti/p/~ratasak1234" target="_blank">ratasak1234</a>
            <hr>
            <small>
                <span>&copy; 2019 Linepop.in.th All Rights Reserved.</span> 
                <span>Designed by <a href="https://linepop.in.th/" target="_blank">Linepop.in.th</a> </span> 
                <!-- <span>Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a></span> -->
            </small>
        </p>
        <ul>
            <li><a href="https://www.facebook.com/line2me.in.th/" target="_blank"><i class="fab fa-facebook"></i></a></li>
            <!-- <li><a href="#"><i class="icon-twitter"></i></a></li>
            <li><a href="#"><i class="icon-instagram"></i></a></li>
            <li><a href="#"><i class="icon-linkedin"></i></a></li> -->
        </ul>
    </div>

</aside>