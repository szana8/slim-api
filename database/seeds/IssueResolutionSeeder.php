<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Admin\Issue\IssueResolution;

class IssueResolutionSeeder extends Seeder
{
    protected $resolution = [
        [
            'name'        => 'Fixed',
            'description' => 'A fix for this issue is checked into the tree and tested.',
        ],
        [
            'name'        => 'Won\'t Fix',
            'description' => 'The problem described is an issue which will never be fixed.',
        ],
        [
            'name'        => 'Duplicate',
            'description' => 'The problem is a duplicate of an existing issue.',
        ],
        [
            'name'        => 'Incomplete',
            'description' => 'The problem is not completely described.',
        ],
        [
            'name'        => 'Cannot Reproduce',
            'description' => 'All attempts at reproducing this issue failed, or not enough information was available to reproduce the issue. Reading the code produces no clues as to why this behavior would occur. If more information appears later, please reopen the issue.',
        ],
        [
            'name'        => 'Unresolved',
            'description' => 'Issue has not been resolved.',
        ],
        [
            'name'        => 'Cancelled',
            'description' => '',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->resolution as $value) {
            $resolution = new IssueResolution();
            $resolution->name = $value['name'];
            $resolution->description = $value['description'];
            $resolution->save();
        }
    }
}
