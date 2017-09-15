<?php

use Illuminate\Database\Seeder;

class IssueStatusSeeder extends Seeder
{
    protected $statuses = [
        [
            'name' => 'Open',
            'description' => 'The issue is open and ready  for the assignee to start work on it.',
            'category' => 'primary'
        ],
        [
            'name' => 'In Progress',
            'description' => 'The issue is being actively worked on at the moment by the assignee.',
            'category' => 'warning'
        ],
        [
            'name' => 'Reopened',
            'description' => 'The issue was one resolved, but this resolution was deemed incorrect. From here issues are either marked assigned or resolved.',
            'category' => 'primary'
        ],
        [
            'name' => 'Resolved',
            'description' => 'A resolution has been taken, and it is awaiting verification by reporter. From here issues are either reopened or are closed.',
            'category' => 'success'
        ],
        [
            'name' => 'Closed',
            'description' => 'The issue is considered finished, the resolution is correct. Issues which are closed can be reopened.',
            'category' => 'success'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $status)
        {
            $issue = new App\Eloquent\Admin\Issue\IssueStatus();
            $issue->name = $status['name'];
            $issue->description = $status['description'];
            $issue->category = $status['category'];
            $issue->save();
        }
    }
}
