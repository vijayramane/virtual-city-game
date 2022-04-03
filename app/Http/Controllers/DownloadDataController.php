<?php

namespace App\Http\Controllers;

use App\Models\GamePlay;

use Illuminate\Http\Request;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

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

        $headerRow = WriterEntityFactory::createRowFromArray(['Username', 'Location', 'Scene', 'Right Attempt', 'Wrong Attempt', 'Total Attempt', 'Total Time', 'Date']);
        $writer->addRow($headerRow);

        foreach ($gamePlays as $gamePlay) {
            $row = WriterEntityFactory::createRowFromArray([
                $gamePlay->username,
                $gamePlay->location,
                $gamePlay->scene,
                $gamePlay->right_attempt,
                $gamePlay->wrong_attempt,
                $gamePlay->total_attempt,
                gmdate("H:i:s", $gamePlay->total_time),
                $gamePlay->created_at
            ]);
            $writer->addRow($row);
        }

        $writer->close();
    }
}
