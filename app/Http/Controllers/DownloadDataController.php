<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

class DownloadDataController extends Controller
{
    
    public function index()
    {
        $game_data = GamePlay::paginate();

        return view('game-data', compact('game_data'));
    }

    public function download(Request $request)
    {
        $gamePlays = GamePlay::all();

        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToBrowser('game-data.xlsx');

        $headerRow = WriterEntityFactory::createRowFromArray(['Location', 'Scene', 'Right Attempt', 'Wrong Attempt', 'Total Attempt', 'Total Time']);
        $writer->addRow($headerRow);

        foreach ($gamePlays as $gamePlay) {
            $row = WriterEntityFactory::createRowFromArray([
                $gamePlay->location,
                $gamePlay->scene,
                $gamePlay->right_attempt,
                $gamePlay->wrong_attempt,
                $gamePlay->total_attempt,
                $gamePlay->total_time
            ]);
            $writer->addRow($row);
        }

        $writer->close();
    }
}
