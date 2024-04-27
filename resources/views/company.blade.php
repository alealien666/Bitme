@extends('user.layouts.nav')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link href="{{ asset('css/company.css') }}" rel="stylesheet" type="text/css" />
{{-- hero section --}}
<section class="hero" id="home">
    <main class="heroContent">
        <h1 class="main">Lorem, ipsum dolor sit amet</h1>
        <p class="mainP">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id, et veniam? Quia impedit ab sit
            nesciunt! Natus,
            doloribus id. Suscipit, quae doloremque voluptates asperiores incidunt optio, numquam pariatur iure dicta,
            harum enim quaerat aliquam beatae!</p>
        <a href="/order" class="heroBtn">Pesan Sekarang</a>
    </main>
</section>
{{-- end --}}

<div class="container">
    {{-- isi --}}
    <section id="about">
        <div class="content">
            <div class="dimensiKiri">
            </div>
            <div class="dimensiKanan" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="sub" data-aos="fade-left" data-aos-duration="1000">Tentang Bitme</h2>
                <ul data-aos="fade-left" data-aos-duration="1000">
                    <li>
                        <p class="sub2">Apa Itu Bitme</p>
                    </li>
                    <p>Bitme adalah snackbar yang terbuat dari labu kuning dan edamame dengan isian buah naga. Snackbar
                        Bitme memiliki dua jenis yaitu fruit dan vegan bar. Bitme Fruit Bar memiliki varian rasa
                        original buah naga, cokelat, dan vanila, sedangkan Bitme Vegan Bar memiliki berbagai isian
                        sayuran di dalamnya. Bitme dibuat tanpa gluten sehingga kaya akan kandungan gizi khususnya serat
                        dan protein, serta mengandung index glikemiks yang rendah karena menggunakan sirup agave sebagai
                        pemanis sehingga aman dikonsumsi oleh seluruh kalangan hingga penderita diabetes dan autis.
                        Dengan mengusung konsep “Green Economy” melaui platform web resmi dan berfokus pada ketahanan
                        pangan berkelanjutan di Indonesia, Bitme dapat menjadi pelopor snackbar sehat yang ramah
                        lingkungan. Jadi tunggu apalagi? Jadikan snackbar Bitme sebagai teman nyemil sehat kamu!
                        Dapatkan sekarang melalui website ataupun mitra Bitme terdekat! Eits, jangan lupa tukarkan
                        kemasan Bitme kamu dan dapatkan hadiah menarik dari minBites!</p>
                    <li>
                        <p class="sub2">Visi & Misi</p>
                    </li>
                    <p>• Visi Bitme :
                        “Menciptakan inovasi snackbar sehat yang berfokus pada ketahanan pangan berkelanjutan berkonsep
                        “green economy” dengan memanfaatkan pangan lokal yang dapat bersaing di pasar dalam negeri
                        hingga mancanegara dalam jangka waktu panjang</p>
                    <p> • Misi Bitme :
                    <ol>
                        <li>Mengutamakan dan memberikan kualitas terbaik snackbar yang kaya akan gizi</li>
                        <li>Berkomitmen untuk memperkuat rantai pasok pangan lokal dengan menggandeng petani lokal dan
                            menyediakan platform untuk pemasaran produk</li>
                        <li>Mendorong konsumen untuk berpartisipasi dalam praktik ekonomi hijau dengan cara menukar
                            kemasan produk pada web resmi Bitme</li>
                        <li>Melakukan riset dan pengembangan untuk menciptakan produk-produk baru yang inovatif dan
                            ramah lingkungan</li>
                        <li>Membuat produk instan yang dapat dikonsumsi oleh semua kalangan masyarakat</li>
                    </ol>
                    </p>

                </ul>
            </div>
        </div>
        <div class="subContent">
            <h2>Mengapa Harus Bitme?</h2>
            <div class="iconBox">
                <ul>
                    <li data-aos="fade-left" data-aos-duration="1000">
                        <div class="icon">
                            <i class="ri-checkbox-circle-fill"></i>
                        </div>
                        <div class="description">
                            <h4>BPOM RI dan Halal MUI
                            </h4>
                            <p>"Bitme adalah pilihan yang tepat untukmu!
                                Bitme telah terdaftar di BPOM, dan bersertifikasi Halal MUI, kami memastikan standar
                                kualitas dan keamanan tertinggi untuk setiap gigitan. Pencapaian tersebut merupakan
                                wujud komitmen kami yang teguh dalam memberikan yang terbaik untukmu."</p>
                        </div>
                    </li>
                    <li data-aos="fade-left" data-aos-duration="1000">
                        <div class="icon">
                            <i class="ri-hand-heart-line"></i>
                        </div>
                        <div class="description">
                            <h4>Increase nutrition
                                Terbaik</h4>
                            <p>Bitme adalah pilihan utama bagi mereka yang mengutamakan rasa dan nutrisi dalam setiap
                                gigitannya. Paduan unik edamame dan labu kuning,memberikan kesegaran dan kelezatan yang
                                tak tertandingi pada setiap gigitan Bitme. Tak hanya itu, dengan tambahan buah-buahan
                                dan sayuran kering, juga memberikan nutrisi yang seimbang untuk mendukung gaya hidup
                                sehat. Jadi, saat lapar datang, Bitme hadir sebagai penyelamat dengan kualitas, rasa,
                                dan harga yang tak akan membuat kecewa.

                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-left" data-aos-duration="1000">
                        <div class="icon">
                            <i class=" ri-flask-line"></i>
                        </div>
                        <div class="description">
                            <h4>Menuju Kesahatan Pangan</h4>
                            <p>Bitme bukan hanya sekadar snack bar biasa, tapi inovasi terbaru menuju ketahanan pangan
                                Indonesia. Nikmati setiap gigitannya sembari mendukung kemajuan lokal. Jadilah bagian
                                dari revolusi rasa dan keberlanjutan dengan Bitme!</p>
                        </div>
                    </li>
                    <li data-aos="fade-right" data-aos-duration="1000">
                        <div class="icon">
                            <i class="ri-currency-line"></i>
                        </div>
                        <div class="description">
                            <h4>Ekonomis dan Mewujudkan Green economy</h4>
                            <p>Paduan unik edamame dan labu kuning, serta tambahan buah-buahan dan sayuran kering tidak
                                hanya memberikan kelezatan yang tak tertandingi tapi juga memberikan nutrisi yang
                                seimbang untuk mendukung gaya hidup yang lebih sehat. Jadi, saat lapar datang, Bitme
                                hadir sebagai penyelamat dengan kualitas, rasa, dan harga yang tak akan membuat kecewa.
                            </p>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </section>
    {{-- end --}}

    {{-- galer --}}
    <section id="galleryProduct">
        <h2 class="titleGallery">Galeri <span>Produk</span></h2>
        <div class="gallery">
            <img src="{{ asset('img/company/y/bg2.png') }}" alt="foto1" class="contentGallery" data-aos="zoom-in-up" data-aos-duration="1000">
            <img src="{{ asset('img/company/y/bg3.jpg') }}" alt="foto2" class="contentGallery" data-aos="zoom-in-up" data-aos-duration="1000">
            <img src="{{ asset('img/company/y/bg4.png') }}" alt="foto3" class="contentGallery" data-aos="zoom-in-up" data-aos-duration="1000">
            <img src="{{ asset('img/company/y/bg5.png') }}" alt="foto4" class="contentGallery" data-aos="zoom-in-up" data-aos-duration="1000">
            <img src="{{ asset('img/company/y/bg6.png') }}" alt="foto5" class="contentGallery" data-aos="zoom-in-up" data-aos-duration="1000">
            <img src="{{ asset('img/company/y/bg8.png') }}" alt="foto7" class="contentGallery" data-aos="zoom-in-up" data-aos-duration="1000">
            <img src="{{ asset('img/company/y/bg7.png') }}" alt="foto6" class="contentGallery" data-aos="zoom-in-up" data-aos-duration="1000">
            <img src="{{ asset('img/company/y/bg9.jpg') }}" alt="foto8" class="contentGallery" data-aos="zoom-in-up" data-aos-duration="1000">
        </div>
    </section>
    {{-- end --}}
</div>

{{-- contact --}}
<section id="contact">
    {{-- <h2>Contact Us</h2> --}}
    <footer>
        <div class="contentWrap">
            <div class="title">
                <i class="ri-flask-fill" id="logo"></i>
                <h3 class="pt-2">Bitme</h3>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt nam, aperiam eaque odio illo
                excepturi
                asperiores quos, vel
            </p>
        </div>
        <div class="contentWrap">
            <h5>Office</h5>
            <p>Jl.tol no 100 <br> rt003/rw004 <br> Boulevard City, Riyadh <br> Saudi Arabia</p>
            <p class="email">Bitme@gmail.com</p>
            <p>+62 8155 9990 6669</p>
        </div>
        <div class="contentWrap">
            <h5>Links</h5>
            <a href="#home" class="link">Home</a>
            <a href="#about" class="link">About</a>
            <a href="#product" class="link">Product</a>
            <a href="#contact" class="link">Contact</a>
        </div>
        <div class="contentWrap">
            <h5>Temukan Kami Di</h5>
            <div class="sosmedWrap">
                <a href="#" class="sosmed"><i class="ri-facebook-fill"></i></a>
                <a href="#" class="sosmed"><i class="ri-instagram-fill"></i></a>
                <a href="#" class="sosmed"><i class="ri-twitter-fill"></i></a>
                <a href="#" class="sosmed"><i class="ri-telegram-fill"></i></a>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <p>Copyright &copy 2024 Bitme </p>
    </div>
</section>
{{-- end --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>