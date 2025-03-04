<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class UpdatePendingReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-pending-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reservations = Reservation::where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subHour())
            ->get();

        foreach ($reservations as $reservation) {
            $reservation->update(['status' => 'canceled']);
            $this->info("Reservation #{$reservation->id} has been canceled.");
        }
    }
}
