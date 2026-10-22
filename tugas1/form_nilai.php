
<?php
$nama = "";
$email = "";
$nilai = "";
$status = "";
$diproses = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = htmlspecialchars(trim($_POST["nama"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $nilai = (int) $_POST["nilai"];
    $diproses = true;

    if ($nilai > 70) {
        $status = "Lulus";
    } else {
        $status = "Remedial";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai Ujian</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f5efe7;
            color: #453329;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1050px;
            margin: 45px auto;
        }

        .header {
            padding-bottom: 22px;
            border-bottom: 1px solid #dfcdbb;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -0.7px;
        }

        .header p {
            margin: 9px 0 0;
            color: #887365;
            font-size: 14px;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: start;
            gap: 24px;
        }

        .card {
            background: #fffdf9;
            border: 1px solid #e3d5c7;
            border-radius: 13px;
            padding: 28px;
            box-shadow: 0 5px 18px rgba(83, 57, 37, 0.04);
        }

        .card h2 {
            font-size: 21px;
            margin: 0 0 9px;
        }

        .description {
            color: #8b796b;
            font-size: 13px;
            line-height: 1.7;
            margin: 0 0 27px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d9cabc;
            border-radius: 7px;
            background: #fffefa;
            font: inherit;
            color: #453329;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #967052;
            box-shadow: 0 0 0 3px #f1e6da;
        }

        input::placeholder {
            color: #b0a398;
        }

        .hint {
            display: block;
            color: #958477;
            font-size: 12px;
            margin-top: 8px;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 7px;
            background: #76543d;
            color: #fffaf5;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #5f422f;
        }

        .result-card {
            border-radius: 10px;
            padding: 22px;
            margin-top: 5px;
            border: 1px solid;
        }

        .result-card.lulus {
            background: #f0f7ed;
            border-color: #c9dfc1;
        }

        .result-card.remedial {
            background: #fff0e8;
            border-color: #f0c6b2;
        }

        .result-title {
            padding-bottom: 18px;
            margin-bottom: 10px;
            border-bottom: 1px solid rgba(120, 95, 75, 0.17);
        }

        .result-title span {
            font-size: 12px;
            color: #847366;
        }

        .result-title h3 {
            margin: 6px 0 0;
            font-size: 24px;
        }

        .lulus .result-title h3 {
            color: #397444;
        }

        .remedial .result-title h3 {
            color: #c34e2b;
        }

        .result-row {
            display: grid;
            grid-template-columns: 95px 10px minmax(0, 1fr);
            gap: 7px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(120, 95, 75, 0.12);
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .result-row:last-child {
            border-bottom: none;
        }

        .result-label {
            font-weight: 600;
        }

        .message {
            margin-top: 13px;
            padding-top: 15px;
            border-top: 1px solid rgba(120, 95, 75, 0.17);
            font-size: 13px;
            line-height: 1.7;
            color: #746457;
        }

        .empty-result {
            min-height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            border: 1px dashed #d9cabc;
            border-radius: 9px;
            padding: 25px;
            color: #8b796b;
        }

        .empty-result strong {
            color: #604936;
            font-size: 16px;
            font-weight: 600;
        }

        .empty-result p {
            font-size: 13px;
            line-height: 1.7;
            margin: 10px 0 0;
        }

        footer {
            text-align: center;
            margin-top: 32px;
            padding: 20px 0;
            border-top: 1px solid #dfcdbb;
            color: #958477;
            font-size: 12px;
        }

        @media (max-width: 750px) {
            .container {
                width: 92%;
                margin: 28px auto;
            }

            .content {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 25px;
            }

            .card {
                padding: 23px 19px;
            }
        }
    </style>
</head>

<body>
    <main class="container">

        <header class="header">
            <h1>Form Nilai Ujian</h1>
            <p>Masukkan data diri dan nilai ujian Anda.</p>
        </header>

        <div class="content">

            <section class="card">
                <h2>Input Data</h2>
                <p class="description">
                    Lengkapi data berikut untuk mengetahui hasil ujian Anda.
                </p>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            placeholder="Masukkan nama lengkap"
                            value="<?php echo $nama; ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Masukkan email aktif"
                            value="<?php echo $email; ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai Ujian</label>
                        <input
                            type="number"
                            id="nilai"
                            name="nilai"
                            min="0"
                            max="100"
                            placeholder="Masukkan nilai (0-100)"
                            value="<?php echo $diproses ? $nilai : ''; ?>"
                            required
                        >
                        <span class="hint">
                            Masukkan nilai antara 0 sampai 100.
                        </span>
                    </div>

                    <button type="submit">Proses Nilai</button>
                </form>
            </section>

            <section class="card">
                <h2>Hasil Ujian</h2>
                <p class="description">
                    Hasil ujian akan muncul setelah data diproses.
                </p>

                <?php if ($diproses) { ?>

                    <div class="result-card <?php echo strtolower($status); ?>">

                        <div class="result-title">
                            <span>Status Ujian</span>
                            <h3><?php echo $status; ?></h3>
                        </div>

                        <div class="result-row">
                            <span class="result-label">Nama</span>
                            <span>:</span>
                            <span><?php echo $nama; ?></span>
                        </div>

                        <div class="result-row">
                            <span class="result-label">Email</span>
                            <span>:</span>
                            <span><?php echo $email; ?></span>
                        </div>

                        <div class="result-row">
                            <span class="result-label">Nilai Ujian</span>
                            <span>:</span>
                            <span><?php echo $nilai; ?></span>
                        </div>

                        <div class="message">
                            <?php if ($status === "Lulus") { ?>
                                Selamat, kamu dinyatakan lulus.
                            <?php } else { ?>
                                Kamu perlu mengikuti remedial. Tetap semangat!
                            <?php } ?>
                        </div>

                    </div>

                <?php } else { ?>

                    <div class="empty-result">
                        <strong>Belum Ada Hasil</strong>
                        <p>
                            Silakan isi form di sebelah kiri dan klik
                            Proses Nilai untuk melihat hasil ujian.
                        </p>
                    </div>

                <?php } ?>
            </section>

        </div>

        <footer>
            Form Nilai Ujian | Praktik PHP
        </footer>

    </main>
</body>
</html>
