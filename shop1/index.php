<?php include 'header.php'; ?>

<style>
    body {
        font-family: 'Noto Sans Khmer', 'Segoe UI', sans-serif;
        background-color: #fff0f5;
    }

    .promotion-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-top: 30px;
    }

    .big-cute-img-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        border-radius: 12px 0 0 12px;
    }

    .big-cute-img {
        width: 80%;
       
        object-fit: cover;
        border-radius: 12px 0 0 12px;
        box-shadow: 0 10px 20px rgba(255, 192, 203, 0.4);
        transition: transform 0.4s ease;
    }

    .big-cute-img-container:hover .big-cute-img {
        transform: scale(1.02);
    }

    .cute-label {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background-color: rgba(255, 240, 245, 0.8);
        color: #363134ff;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 30px;
        box-shadow: 0 5px 10px rgba(255, 105, 180, 0.2);
    }

    .promo-text {
        background-color: #fffafc;
        padding: 30px;
        border-left: 5px solid #4b4146ff;
        border-radius: 0 12px 12px 0;
    }

    .promo-text h4 {
        color: #302a2cff;
        font-size: 22px;
        font-weight: bold;
    }

    .promo-text ul {
        list-style: none;
        padding-left: 0;
    }

    .promo-text ul li::before {
        content: "🎀 ";
        margin-right: 4px;
    }

    .falling {
        position: absolute;
        top: -50px;
        pointer-events: none;
        user-select: none;
        animation: fall linear forwards;
    }

    @keyframes fall {
        to {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }

    @media (max-width: 768px) {
        .promotion-section {
            flex-direction: column;
        }

        .big-cute-img {
            border-radius: 12px 12px 0 0;
        }

        .promo-text {
            border-radius: 0 0 12px 12px;
            border-left: none;
            border-top: 5px solid #7a7477ff;
        }
    }
</style>

<div class="container">
    <div class="row promotion-section d-flex align-items-stretch">
        <!-- Left Big Cute Image -->
        <div class="col-md-8 p-0 position-relative">
            <div class="big-cute-img-container h-100">
                <img src="../img/img3.jpg" alt="Cute Big Promotion" class="big-cute-img">
                <div class="cute-label">🌸 ឱកាសពិសេស! 🛍️</div>
            </div>
        </div>

        <!-- Right Promo Text -->
        <div class="col-md-4 promo-text">
    <h4 class="mb-3">🌟 ហាងតុក្តតា Chheng កំពុងមានកម្មវិធីបញ្ចុះតម្លៃពិសេស!</h4>

    <p>🛍️ អ្វីដែលអ្នកអាចរកបាន:</p>
    <ul>
        <li>🧸 តុក្តតា​សម្រាប់​ក្មេងៗគ្រប់វ័យ</li>
        <li>🎎 តុក្តតាជប៉ុន, កូរ៉េ, និងប្រទេសផ្សេងៗ</li>
        <li>🪅 តុក្តតាអប់រំ និងអភិវឌ្ឍបច្ចេកទេស</li>
        <li>🎮 ផលិតផលទាក់ទាញសម្រាប់កុមារ</li>
    </ul>

    <p>🔥 បញ្ចុះតម្លៃពិសេស:</p>
    <ul>
        <li>🎉 បញ្ចុះតម្លៃដល់ទៅ 40% លើតុក្តតាជ្រើសរើស</li>
        <li>🎁 ការផ្តល់ជូនពិសេសសម្រាប់ការទិញច្រើន</li>
    </ul>

    <div style="font-size: 15px;">
        <p>📍 <strong>ទីតាំង:</strong> ភូមិព្រៃទទឺង​ ឃុំព្រះនិពាន្ធ ស្រុកគងពិសី ខេត្តកំពង់ស្ពឺ</p>
        <p>⏰ <strong>ម៉ោងបើក:</strong> 7:00 AM - 10:00 PM</p>
        <p>📞 <strong>ទំនាក់ទំនង:</strong> 097 xxx xxxx , 096 xxx xxxx</p>
    </div>
</div>

        </div>
    </div>
</div>

<script>
    const icons = ['🐷', '🐼', '🌸', '🐹', '🦝', '🐯'];

    function createFallingIcon() {
        const el = document.createElement('div');
        el.className = 'falling';
        el.textContent = icons[Math.floor(Math.random() * icons.length)];
        el.style.left = Math.random() * 100 + 'vw';
        el.style.fontSize = (24 + Math.random() * 20) + 'px';
        el.style.animationDuration = (3 + Math.random() * 5) + 's';
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 8000);
    }

    setInterval(createFallingIcon, 250);
</script>

<?php include 'footer.php'; ?>
