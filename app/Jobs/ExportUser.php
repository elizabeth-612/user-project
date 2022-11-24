<?php

namespace App\Jobs;

use App\Data\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportUser implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=user' . time() . '.csv');

        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        $headers = ['Name', 'Email', 'Mobile', 'Location', 'Gender'];
        fputcsv($output, $headers);

        User::chunk(200, function ($records) use ($headers, $output) {
            foreach ($records as $record) {
                $row = [];
                foreach ($headers as $column) {
                    // $row = [];
                    $row[] = $record->name;
                    $row[] = $record->email;
                    $row[] = $record->phone;
                    $row[] = $record->location;
                    $row[] = $record->gender;

                    // fputcsv($output, $row);
                }
                fputcsv($output, $row);
            }
        });

        // foreach ($users as  $key => $user) {

        //     $row = [];
        //     $row[] = $user->name;
        //     $row[] = $user->email;
        //     $row[] = $user->phone;
        //     $row[] = $user->location;
        //     $row[] = $user->gender;

        //     fputcsv($output, $row);
        // }
        fclose($output);
    }
}
