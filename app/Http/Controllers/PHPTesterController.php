<?php namespace App\Http\Controllers;

class PHPTesterController extends BaseController
{

    /**
     * Some page
     *
     * @return Response
     */
    public function getPhpTester()
    {
        $status = \App\Models\Status::find(19);
        $photo = \App\Models\Photo::find(10);

        $startTime = microtime(true);
        for ($x = 0; $x < 1000000; $x++) {
            $titleOne = $status->getActivityNameTwo($photo);
        }
        $endTime = microtime(true);

        $elapsed = $endTime - $startTime;

        dd("Execution time : $elapsed seconds");
    }
}
