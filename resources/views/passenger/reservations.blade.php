<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations | GrandTaxiGo</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">GrandTaxiGo</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/profile" class="text-indigo-600 hover:text-indigo-800 transition">Mon Profil</a>
                        <a href="/reservations" class="text-indigo-600 hover:text-indigo-800 transition">Mes Réservations</a>
                        <a href="/aide" class="text-indigo-600 hover:text-indigo-800 transition">Aide</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Mes Réservations</h2>
                <p class="text-gray-600">Consultez et gérez vos réservations de trajets</p>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Chauffeur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Point de départ</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date et heure</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(Auth::user()->reservations)
                            @foreach(Auth::user()->reservations as $reservation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('/storage/'.$reservation->driver->user->photo) }}" alt="Michel Bernard">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $reservation->driver->user->fname.' '.$reservation->driver->user->lname }}</div>
                                                <div class="text-sm text-gray-500">{{ $reservation->driver->user->phone }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $reservation->trajet->startPlace }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $reservation->trajet->destination }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $reservation->created_at }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($reservation->status == 'done')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $reservation->status }}</span>
                                        @elseif($reservation->status == 'accepted')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Accepted
                                        </span>
                                        @elseif($reservation->status == 'rejected')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                        @elseif($reservation->status == 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Canceled
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($reservation->status == 'pending')
                                        <a href="/reservation/cancel/{{ $reservation->id }}" class="text-red-600 hover:text-red-900">
                                            Cancel
                                        </a>
                                        @elseif($reservation->status == 'accepted')
                                        <a href="/reservation/details/{{ $reservation->id }}" class="text-blue-600 hover:text-blue-900">
                                            Details
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pas de réservations message (caché par défaut) -->
            <div class="hidden bg-white rounded-lg shadow-md p-6 text-center mt-6">
                <div class="text-gray-600 mb-4">
                    <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                    <p class="text-lg">Vous n'avez aucune réservation pour le moment.</p>
                </div>
                <a href="/" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Rechercher un chauffeur
                </a>
            </div>
        </main>
    </div>
</body>
</html>