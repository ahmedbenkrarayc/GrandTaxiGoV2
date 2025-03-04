<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilité | GrandTaxiGo</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Base styles */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            color: #374151;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        
        /* Utility classes */
        .bg-gray-100 { background-color: #f3f4f6; }
        .bg-white { background-color: white; }
        .text-indigo-600 { color: #4f46e5; }
        .text-indigo-800 { color: #3730a3; }
        .text-gray-600 { color: #4b5563; }
        .text-gray-800 { color: #1f2937; }
        .font-bold { font-weight: 700; }
        .text-2xl { font-size: 1.5rem; }
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .rounded-lg { border-radius: 0.5rem; }
        .py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mt-8 { margin-top: 2rem; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .min-h-screen { min-height: 100vh; }
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .space-x-4 > * + * { margin-left: 1rem; }
        .transition { transition: all 0.3s ease; }
        .hover\:text-indigo-800:hover { color: #3730a3; }
        .underline { text-decoration: underline; }
        .max-w-7xl { max-width: 80rem; }
        .p-8 { padding: 2rem; }
        .gap-4 { gap: 1rem; }
        .w-full { width: 100%; }
        .grid { display: grid; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .cursor-pointer { cursor: pointer; }
        
        @media (min-width: 640px) {
            .sm\:px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
            .sm\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }
        
        @media (min-width: 1024px) {
            .lg\:px-8 { padding-left: 2rem; padding-right: 2rem; }
        }
        
        /* Navigation */
        nav {
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .nav-container {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .nav-content {
            display: flex;
            justify-content: space-between;
            height: 4rem;
        }
        
        .nav-logo {
            display: flex;
            align-items: center;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
        }
        
        .nav-links a {
            margin-left: 1rem;
            text-decoration: none;
            color: #4f46e5;
            transition: color 0.3s ease;
        }
        
        .nav-links a:hover {
            color: #3730a3;
        }
        
        .nav-links a.active {
            font-weight: 500;
            text-decoration: underline;
        }
        
        /* Status option styles */
        .status-options {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        @media (min-width: 640px) {
            .status-options {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        
        .status-option {
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .status-option:hover {
            border-color: #d1d5db;
        }
        
        .status-option.selected {
            border-color: #4f46e5;
            background-color: #eef2ff;
        }
        
        .status-icon {
            font-size: 2rem;
            margin-bottom: 0.75rem;
        }
        
        .status-title {
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
        }
        
        .status-description {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .available .status-icon {
            color: #10b981;
        }
        
        .busy .status-icon {
            color: #f59e0b;
        }
        
        .unavailable .status-icon {
            color: #ef4444;
        }
        
        /* Submit button */
        .submit-btn {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 2rem;
        }
        
        .submit-btn:hover {
            background-color: #4338ca;
        }
        
        /* Hide actual radio buttons */
        .status-radio {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Barre de navigation -->
        <nav>
            <div class="nav-container">
                <div class="nav-content">
                    <div class="nav-logo">
                        <h1 class="text-2xl font-bold text-indigo-600">GrandTaxiGo</h1>
                    </div>
                    <div class="nav-links">
                        <a href="/driver/profile" class="text-indigo-600 hover:text-indigo-800 transition">Mon Profil</a>
                        <a href="/driver/courses" class="text-indigo-600 hover:text-indigo-800 transition">Mes Courses</a>
                        <a href="/driver/disponibilite" class="text-indigo-600 font-medium underline hover:text-indigo-800 transition">Disponibilité</a>
                        <a href="/driver/statistiques" class="text-indigo-600 hover:text-indigo-800 transition">Statistiques</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Gestion de Disponibilité</h2>
                <p class="text-gray-600">Mettez à jour votre statut de disponibilité pour recevoir des courses</p>
            </div>

            
            <div class="bg-white rounded-lg shadow-lg p-8">
                <ul class="mb-4 list-disc">
                    @foreach($errors->all() as $error)
                    <li class="text-red-600">{{ $error }}</li>
                    @endforeach
                </ul>
                @if(session('success'))
                <p class="text-green-600 mb-4">{{ session('success') }}</p>
                @endif
                <h3 class="text-xl font-bold text-gray-800 mb-6">Votre statut actuel</h3>
                
                <form method="POST" action="/driver/updateAvailability" id="disponibilityForm">
                    @csrf
                    @method('PUT')
                    <div class="status-options">
                        <label class="status-option available" id="option-available">
                            <input type="radio" name="status" value="available" class="status-radio" @checked(Auth::user()->driver && Auth::user()->driver->availability === 'available')>
                            <div class="status-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="status-title">Disponible</div>
                            <div class="status-description">Vous êtes prêt à accepter des courses</div>
                        </label>
                        
                        <label class="status-option busy" id="option-busy">
                            <input type="radio" name="status" value="busy" class="status-radio" @checked(Auth::user()->driver && Auth::user()->driver->availability === 'busy')>
                            <div class="status-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="status-title">Actuellement occupé</div>
                            <div class="status-description">En pause temporaire, indisponible pour le moment</div>
                        </label>
                        
                        <label class="status-option unavailable" id="option-unavailable">
                            <input type="radio" name="status" value="unavailable" class="status-radio" @checked(Auth::user()->driver && Auth::user()->driver->availability === 'unavailable')>
                            <div class="status-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="status-title">Indisponible</div>
                            <div class="status-description">Vous ne souhaitez pas recevoir de courses aujourd'hui</div>
                        </label>
                    </div>
                    
                    <button type="submit" class="submit-btn">Mettre à jour mon statut</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusOptions = document.querySelectorAll('.status-option');
            const radioInputs = document.querySelectorAll('.status-radio');

            // Find the checked radio button and add the 'selected' class to its parent
            radioInputs.forEach(input => {
                if (input.checked) {
                    input.closest('.status-option').classList.add('selected');
                }
            });

            // Handle click on status options
            statusOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    statusOptions.forEach(opt => opt.classList.remove('selected'));

                    // Add selected class to clicked option
                    this.classList.add('selected');

                    // Check the radio input within this option
                    const radio = this.querySelector('.status-radio');
                    radio.checked = true;
                });
            });
        });

    </script>
</body>
</html>