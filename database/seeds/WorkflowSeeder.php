<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Issue\Workflow;

class WorkflowSeeder extends Seeder
{
    protected $json = '{ "class": "go.GraphLinksModel",
  "linkFromPortIdProperty": "fromPort",
  "linkToPortIdProperty": "toPort",
  "nodeDataArray": [ 
{"key":-1, "category":"Start", "loc":"-75 -8", "text":"Start"},
{"key":-2, "category":"End", "loc":"175 640", "text":"End!"},
{"category":"primary", "text":"Open", "key":-3, "loc":"-72.8125 139"},
{"category":"warning", "text":"In Progress", "key":-4, "loc":"-74.8125 452"},
{"category":"success", "text":"Resolved", "key":-6, "loc":"280.1875 140"},
{"category":"primary", "text":"Reopen", "key":-7, "loc":"433.1875 535"},
{"category":"success", "text":"Closed", "key":-5, "loc":"54.1875 299"}
 ],
  "linkDataArray": [ 
{"from":-1, "to":-3, "fromPort":"B", "toPort":"T", "points":[-75,16.773340092148892,-75,26.773340092148892,-75,72.28709601939785,-72.81250000000003,72.28709601939785,-72.81250000000003,117.80085194664682,-72.81250000000003,127.80085194664682], "text":"Create Issue"},
{"from":-3, "to":-4, "fromPort":"B", "toPort":"T", "points":[-72.81250000000003,150.19914805335318,-72.81250000000003,160.19914805335318,-72.81250000000003,295.5,-74.8125,295.5,-74.8125,430.8008519466468,-74.8125,440.8008519466468], "text":"Start Progress"},
{"from":-4, "to":-3, "fromPort":"L", "toPort":"L", "points":[-118.4032007877282,452,-128.4032007877282,452,-191.8125,452,-191.8125,139,-104.80693308753291,139,-94.80693308753291,139], "text":"Stop Progress"},
{"from":-3, "to":-6, "fromPort":"R", "toPort":"L", "points":[-50.81806691246716,139,-40.81806691246716,139,95.1875,139,95.1875,140,234.33480580406868,140,244.33480580406868,140], "text":"Resolve Issue"},
{"from":-6, "to":-7, "fromPort":"B", "toPort":"T", "points":[280.1875,151.19914805335318,280.1875,161.19914805335318,280.1875,337.5,433.1875,337.5,433.1875,513.8008519466468,433.1875,523.8008519466468], "text":"Reopen Issue"},
{"from":-7, "to":-6, "fromPort":"R", "toPort":"R", "points":[463.32795969886104,535,473.32795969886104,535,473.32795969886104,140,399.6840769473962,140,326.0401941959313,140,316.0401941959313,140], "text":"Resolve Issue"},
{"from":-4, "to":-6, "fromPort":"R", "toPort":"L", "points":[-31.22179921227182,452,-21.22179921227182,452,149.1875,452,149.1875,140,234.33480580406868,140,244.33480580406868,140], "text":"Resolve Issue"},
{"from":-4, "to":-5, "fromPort":"R", "toPort":"L", "points":[-31.22179921227182,452,-21.22179921227182,452,-2.366905212402351,452,-2.366905212402351,299,16.487988787467117,299,26.487988787467117,299], "text":"Close Issue"},
{"from":-6, "to":-5, "fromPort":"B", "toPort":"T", "points":[280.1875,151.19914805335318,280.1875,161.19914805335318,280.1875,219.5,54.18749999999999,219.5,54.18749999999999,277.8008519466468,54.18749999999999,287.8008519466468], "text":"Close Issue"},
{"from":-7, "to":-5, "fromPort":"L", "toPort":"R", "points":[403.047040301139,535,393.047040301139,535,242.46702575683594,535,242.46702575683594,299,91.88701121253287,299,81.88701121253287,299], "text":"Close Issue"},
{"from":-5, "to":-2, "fromPort":"B", "toPort":"L", "points":[54.18749999999999,310.19914805335316,54.18749999999999,320.19914805335316,54.18749999999999,640,97.50879589346953,640,140.83009178693905,640,150.83009178693905,640], "text":"End"}
 ]}';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workflow = new Workflow();
        $workflow->name = 'Default Software Development Workflow';
        $workflow->description = 'Default Slim Workflow';
        $workflow->descriptor = $this->json;

        $workflow->save();
    }
}
