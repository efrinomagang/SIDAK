<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Pendataan Mahasiswa</title>
    @vite('resources/css/app.css')
    <style>
        /* Responsive full-screen background */
        body {
            background: #f3f4f6;
            overflow: hidden;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Background slideshow container */
        .background-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* Slideshow animation */
        .background-slideshow img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            opacity: 0;
            animation: fadeSlide 30s infinite;
        }

        /* Keyframes for fading and sliding */
        @keyframes fadeSlide {
            0% { opacity: 1; }
            20% { opacity: 1; }
            25% { opacity: 0; }
            100% { opacity: 0; }
        }

        /* Staggering the animation start for each image */
        .background-slideshow img:nth-child(1) {
            animation-delay: 0s;
        }
        .background-slideshow img:nth-child(2) {
            animation-delay: 5s;
        }
        .background-slideshow img:nth-child(3) {
            animation-delay: 10s;
        }
        .background-slideshow img:nth-child(4) {
            animation-delay: 15s;
        }
        .background-slideshow img:nth-child(5) {
            animation-delay: 20s;
        }
        .background-slideshow img:nth-child(6) {
            animation-delay: 25s;
        }

        /* Welcome container styling */
        .welcome-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn ease 2s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .welcome-container h1 {
            font-size: 2.25rem;
            margin-bottom: 1rem;
        }

        .welcome-container p {
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
        }

        /* Login button styling */
        .welcome-container a {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            transition: transform 0.3s, background-color 0.3s;
        }

        .welcome-container a:hover {
            transform: scale(1.05);
            background-color: #2563eb;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .welcome-container {
                width: 90%;
            }

            .welcome-container h1 {
                font-size: 1.875rem;
            }

            .welcome-container p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Background Slideshow -->
    <div class="background-slideshow">
        <img src="https://mamikos.com/info/wp-content/uploads/2020/05/polnes.jpg" alt="Background Image 1">
        <img src="https://web.polines.ac.id/wp-content/uploads/2021/12/kegiatan-mahasiswa-polines-smile-1-e1639042463862.jpg" alt="Background Image 2">
        <img src="https://web.polines.ac.id/wp-content/uploads/2023/08/RAMAH-LINGKUNGAN-DAN-DISABILITAS-GEDUNG-BARU-POLINES-DIBERI-NAMA-GEDUNG-IGNATIUS-DARMOJO.jpg" alt="Background Image 3">
        <img src="https://web.polines.ac.id/wp-content/uploads/2023/09/artikel-gelar-wisuda.jpeg" alt="Background Image 4">
        <img src="https://web.polines.ac.id/wp-content/uploads/2021/11/DSC_3951-1024x576.jpg" alt="Background Image 5">
        <img src="https://me.polines.ac.id/wp-content/uploads/slider/cache/0e5c89f3474543b37f43965563cf7cbb/DSC5600-scaled.jpg" alt="Background Image 6">
    </div>

    <!-- Welcome Container -->
    <div class="welcome-container">
        <h1>Selamat Datang di SIDAK ( Sistem Data Akademik )</h1>
        <p>Silahkan Login terlebih dahulu.</p>
        <a href="{{ route('login') }}" class="mt-6">Login</a>
    </div>

</body>
</html>
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Pendataan Mahasiswa</title>
    @vite('resources/css/app.css')
    <style>
        /* Full-screen layout */
        body {
            background: #f3f4f6;
            overflow: hidden;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Background slideshow container */
        .background-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 600%;
            height: 100%;
            display: flex;
            z-index: -1;
        }

        /* Slideshow swipe animation */
        .background-slideshow img {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        @keyframes swipeLeft {
            0% { transform: translateX(0); }
            16.66% { transform: translateX(-100vw); }
            33.32% { transform: translateX(-200vw); }
            49.98% { transform: translateX(-300vw); }
            66.64% { transform: translateX(-400vw); }
            83.3% { transform: translateX(-500vw); }
            100% { transform: translateX(0); }
        }

        /* Apply the swipe animation to the slideshow container */
        .background-slideshow {
            animation: swipeLeft 30s infinite linear;
        }

        /* Welcome container styling */
        .welcome-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn ease 2s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .welcome-container h1 {
            font-size: 2.25rem;
            margin-bottom: 1rem;
        }

        .welcome-container p {
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
        }

        /* Login button styling */
        .welcome-container a {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            transition: transform 0.3s, background-color 0.3s;
        }

        .welcome-container a:hover {
            transform: scale(1.05);
            background-color: #2563eb;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .welcome-container {
                width: 90%;
            }

            .welcome-container h1 {
                font-size: 1.875rem;
            }

            .welcome-container p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Background Slideshow -->
    <div class="background-slideshow">
        <img src="https://mamikos.com/info/wp-content/uploads/2020/05/polnes.jpg" alt="Background Image 1">
        <img src="https://web.polines.ac.id/wp-content/uploads/2021/12/kegiatan-mahasiswa-polines-smile-1-e1639042463862.jpg" alt="Background Image 2">
        <img src="https://web.polines.ac.id/wp-content/uploads/2023/08/RAMAH-LINGKUNGAN-DAN-DISABILITAS-GEDUNG-BARU-POLINES-DIBERI-NAMA-GEDUNG-IGNATIUS-DARMOJO.jpg" alt="Background Image 3">
        <img src="https://web.polines.ac.id/wp-content/uploads/2023/09/artikel-gelar-wisuda.jpeg" alt="Background Image 4">
        <img src="https://web.polines.ac.id/wp-content/uploads/2021/11/DSC_3951-1024x576.jpg" alt="Background Image 5">
        <img src="https://me.polines.ac.id/wp-content/uploads/slider/cache/0e5c89f3474543b37f43965563cf7cbb/DSC5600-scaled.jpg" alt="Background Image 6">
    </div>

    <!-- Welcome Container -->
    <div class="welcome-container">
        <h1>Welcome to Pendataan Mahasiswa</h1>
        <p>Please login to continue.</p>
        <a href="{{ route('login') }}" class="mt-6">Login</a>
    </div>

</body>
</html> --}}
