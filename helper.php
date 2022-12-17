<?php
require_once __DIR__ . '/scripts/helper_load.php';

/**
 * 转换Nginx数据
 */
function transformNginxData(string $domain): array
{
    $domainData = [
        'domain' => $domain,
        'total_all' => 0,
        'total_error' => 0,
        'total_1' => 0,
        'total_2' => 0,
        'total_3' => 0,
        'total_5' => 0,
        'total_10' => 0,
        'uri_list' => [],
    ];
    $uriList = [];
    $domainHours = [
        '00' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '01' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '02' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '03' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '04' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '05' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '06' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '07' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '08' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '09' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '10' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '11' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '12' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '13' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '14' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '15' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '16' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '17' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '18' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '19' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '20' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '21' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '22' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
        '23' => [
            'num_total' => 0,
            'num_error' => 0,
            'num_1' => 0,
            'num_2' => 0,
            'num_3' => 0,
            'num_5' => 0,
            'num_10' => 0,
        ],
    ];
    $domainFile = fopen(__DIR__ . '/temp/log/nginx_report_data/' . $domain . '_sort.txt', 'r');
    while (!feof($domainFile)) {
        $domainContent = fgets($domainFile);
        if (is_bool($domainContent)) {
            continue;
        }
        if (strlen($domainContent) <= 6) {
            continue;
        }

        $domainArr = explode(' ', $domainContent);
        $uri = $domainArr[0];
        $uriTag = $domainArr[2];
        $reqStatus = (int)$domainArr[1];
        $hour = $domainArr[3];
        $uriNum = (int)$domainArr[4];
        $domainData['total_all'] += $uriNum;
        $domainHours[$hour]['num_total'] += $uriNum;
        if ($reqStatus >= 300) {
            $domainData['total_error'] += $uriNum;
            $domainHours[$hour]['num_error'] += $uriNum;
        }
        if ('999' == $uriTag) {
            if (isset($uriList[$uri])) {
                $uriList[$uri]['num_total'] += $uriNum;
                if ($reqStatus >= 300) {
                    $uriList[$uri]['num_error'] += $uriNum;
                }
            }
        } else {
            if (!isset($uriList[$uri])) {
                $uriList[$uri] = [
                    'num_total' => 0,
                    'num_error' => 0,
                    'num_1' => 0,
                    'num_2' => 0,
                    'num_3' => 0,
                    'num_5' => 0,
                    'num_10' => 0,
                ];
            }

            $uriList[$uri]['num_total'] += $uriNum;
            if ($reqStatus >= 300) {
                $uriList[$uri]['num_error'] += $uriNum;

                continue;
            }

            $domainData['total_1'] += $uriNum;
            $uriList[$uri]['num_1'] += $uriNum;
            $domainHours[$hour]['num_1'] += $uriNum;
            if ('002' == $uriTag) {
                $domainData['total_2'] += $uriNum;
                $uriList[$uri]['num_2'] += $uriNum;
                $domainHours[$hour]['num_2'] += $uriNum;
            } elseif ('003' == $uriTag) {
                $domainData['total_2'] += $uriNum;
                $domainData['total_3'] += $uriNum;
                $uriList[$uri]['num_2'] += $uriNum;
                $uriList[$uri]['num_3'] += $uriNum;
                $domainHours[$hour]['num_2'] += $uriNum;
                $domainHours[$hour]['num_3'] += $uriNum;
            } elseif ('004' == $uriTag) {
                $domainData['total_2'] += $uriNum;
                $domainData['total_3'] += $uriNum;
                $domainData['total_5'] += $uriNum;
                $uriList[$uri]['num_2'] += $uriNum;
                $uriList[$uri]['num_3'] += $uriNum;
                $uriList[$uri]['num_5'] += $uriNum;
                $domainHours[$hour]['num_2'] += $uriNum;
                $domainHours[$hour]['num_3'] += $uriNum;
                $domainHours[$hour]['num_5'] += $uriNum;
            } elseif ('005' == $uriTag) {
                $domainData['total_2'] += $uriNum;
                $domainData['total_3'] += $uriNum;
                $domainData['total_5'] += $uriNum;
                $domainData['total_10'] += $uriNum;
                $uriList[$uri]['num_2'] += $uriNum;
                $uriList[$uri]['num_3'] += $uriNum;
                $uriList[$uri]['num_5'] += $uriNum;
                $uriList[$uri]['num_10'] += $uriNum;
                $domainHours[$hour]['num_2'] += $uriNum;
                $domainHours[$hour]['num_3'] += $uriNum;
                $domainHours[$hour]['num_5'] += $uriNum;
                $domainHours[$hour]['num_10'] += $uriNum;
            }
        }
    }
    fclose($domainFile);

    if ($domainData['total_all'] > 0) {
        $domainData['percent_error'] = number_format(($domainData['total_error'] / $domainData['total_all'] * 100), 5) . '%';
        $domainData['percent_1'] = number_format(($domainData['total_1'] / $domainData['total_all'] * 100), 5) . '%';
        $domainData['percent_2'] = number_format(($domainData['total_2'] / $domainData['total_all'] * 100), 5) . '%';
        $domainData['percent_3'] = number_format(($domainData['total_3'] / $domainData['total_all'] * 100), 5) . '%';
        $domainData['percent_5'] = number_format(($domainData['total_5'] / $domainData['total_all'] * 100), 5) . '%';
        $domainData['percent_10'] = number_format(($domainData['total_10'] / $domainData['total_all'] * 100), 5) . '%';
        $saveData = [];
        foreach ($uriList as $uri => $uriData) {
            $saveData[$uri] = $uriData['num_1'];
        }
        arsort($saveData, SORT_NUMERIC);
        foreach ($saveData as $uri => $uriNum) {
            $nowData = $uriList[$uri];
            $nowData['percent_error'] = number_format(($nowData['num_error'] / $nowData['num_total'] * 100), 5) . '%';
            $nowData['percent_1'] = number_format(($nowData['num_1'] / $nowData['num_total'] * 100), 5) . '%';
            $nowData['percent_2'] = number_format(($nowData['num_2'] / $nowData['num_total'] * 100), 5) . '%';
            $nowData['percent_3'] = number_format(($nowData['num_3'] / $nowData['num_total'] * 100), 5) . '%';
            $nowData['percent_5'] = number_format(($nowData['num_5'] / $nowData['num_total'] * 100), 5) . '%';
            $nowData['percent_10'] = number_format(($nowData['num_10'] / $nowData['num_total'] * 100), 5) . '%';
            $domainData['uri_list'][$uri] = $nowData;
        }

        $imageData = [
            'hours' => array_keys($domainHours),
            'yticks' => [
                0,
            ],
            'data' => [
                0 => [
                    'line_label' => 'time>1s',
                    'line_color' => '#499C54',
                    'percents' => [],
                ],
                1 => [
                    'line_label' => 'time>2s',
                    'line_color' => '#289FC2',
                    'percents' => [],
                ],
                2 => [
                    'line_label' => 'time>3s',
                    'line_color' => '#DD5347',
                    'percents' => [],
                ],
                3 => [
                    'line_label' => 'time>5s',
                    'line_color' => '#272822',
                    'percents' => [],
                ],
                4 => [
                    'line_label' => 'time>10s',
                    'line_color' => '#C545E3',
                    'percents' => [],
                ],
            ],
        ];
        foreach ($domainHours as $hourData) {
            if ($hourData['num_total'] > 0) {
                $imageData['data'][0]['percents'][] = (float)number_format(($hourData['num_1'] / $hourData['num_total'] * 100), 5);
                $imageData['data'][1]['percents'][] = (float)number_format(($hourData['num_2'] / $hourData['num_total'] * 100), 5);
                $imageData['data'][2]['percents'][] = (float)number_format(($hourData['num_3'] / $hourData['num_total'] * 100), 5);
                $imageData['data'][3]['percents'][] = (float)number_format(($hourData['num_5'] / $hourData['num_total'] * 100), 5);
                $imageData['data'][4]['percents'][] = (float)number_format(($hourData['num_10'] / $hourData['num_total'] * 100), 5);
            } else {
                $imageData['data'][0]['percents'][] = 0.0;
                $imageData['data'][1]['percents'][] = 0.0;
                $imageData['data'][2]['percents'][] = 0.0;
                $imageData['data'][3]['percents'][] = 0.0;
                $imageData['data'][4]['percents'][] = 0.0;
            }
        }
        $savePercent = [
            max($imageData['data'][0]['percents']),
            max($imageData['data'][1]['percents']),
            max($imageData['data'][2]['percents']),
            max($imageData['data'][3]['percents']),
            max($imageData['data'][4]['percents']),
        ];
        $percentMaxNum = (int)(max($savePercent) * 100000);
        if ($percentMaxNum > 6000000) {
            $intervalNum = 500000;
        } elseif ($percentMaxNum > 3000000) {
            $intervalNum = 300000;
        } elseif ($percentMaxNum > 1000000) {
            $intervalNum = 150000;
        } elseif ($percentMaxNum > 600000) {
            $intervalNum = 50000;
        } elseif ($percentMaxNum > 300000) {
            $intervalNum = 30000;
        } elseif ($percentMaxNum > 100000) {
            $intervalNum = 15000;
        } elseif ($percentMaxNum > 60000) {
            $intervalNum = 5000;
        } elseif ($percentMaxNum > 30000) {
            $intervalNum = 3000;
        } elseif ($percentMaxNum > 10000) {
            $intervalNum = 1500;
        } elseif ($percentMaxNum > 6000) {
            $intervalNum = 500;
        } elseif ($percentMaxNum > 3000) {
            $intervalNum = 300;
        } elseif ($percentMaxNum > 1000) {
            $intervalNum = 150;
        } elseif ($percentMaxNum > 600) {
            $intervalNum = 50;
        } elseif ($percentMaxNum > 300) {
            $intervalNum = 30;
        } elseif ($percentMaxNum > 100) {
            $intervalNum = 15;
        } elseif ($percentMaxNum > 0) {
            $intervalNum = 5;
        } else {
            $intervalNum = 0;
        }
        if ($intervalNum > 0) {
            $needNum = 0;
            for ($i = 0; $i < 20; ++$i) {
                $needNum += $intervalNum;
                $imageData['yticks'][] = $needNum / 100000;
            }
            file_put_contents(__DIR__ . '/temp/log/nginx_report_data/' . $domain . '.json', \SyTool\Tool::jsonEncode($imageData, JSON_UNESCAPED_UNICODE));
        }
    }

    return $domainData;
}

/**
 * 生成Nginx excel文件
 *
 * @param array  $domainData 域名数据
 * @param string $date       日期
 * @param string $totalStr   归总文件内容
 */
function createNginxExcel(array $domainData, string $date, string &$totalStr)
{
    if ($domainData['total_all'] <= 0) {
        return;
    }

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0);
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', '')
        ->setCellValue('B1', '总请求数: ' . $domainData['total_all'])
        ->setCellValue('C1', '耗时1s请求数: ' . $domainData['total_1'] . ',占比: ' . $domainData['percent_1'])
        ->setCellValue('D1', '耗时2s请求数: ' . $domainData['total_2'] . ',占比: ' . $domainData['percent_2'])
        ->setCellValue('E1', '耗时3s请求数: ' . $domainData['total_3'] . ',占比: ' . $domainData['percent_3'])
        ->setCellValue('F1', '耗时5s请求数: ' . $domainData['total_5'] . ',占比: ' . $domainData['percent_5'])
        ->setCellValue('G1', '耗时10s请求数: ' . $domainData['total_10'] . ',占比: ' . $domainData['percent_10'])
        ->setCellValue('H1', '错误请求数: ' . $domainData['total_error'] . ',占比: ' . $domainData['percent_error'])
        ->setCellValue('A2', '请求URI')
        ->setCellValue('B2', '总请求数')
        ->setCellValue('C2', '耗时1s请求数')
        ->setCellValue('D2', '耗时2s请求数')
        ->setCellValue('E2', '耗时3s请求数')
        ->setCellValue('F2', '耗时5s请求数')
        ->setCellValue('G2', '耗时10s请求数')
        ->setCellValue('H2', '错误请求数')
        ->setCellValue('I2', '耗时1s以上占比')
        ->setCellValue('J2', '耗时2s以上占比')
        ->setCellValue('K2', '耗时3s以上占比')
        ->setCellValue('L2', '耗时5s以上占比')
        ->setCellValue('M2', '耗时10s以上占比')
        ->setCellValue('N2', '错误请求占比');
    $totalStr .= $domainData['domain'] . PHP_EOL
                 . '总请求数:' . $domainData['total_all']
                 . ' 耗时1s请求数:' . $domainData['total_1'] . ',占比:' . $domainData['percent_1']
                 . ' 耗时2s请求数:' . $domainData['total_2'] . ',占比:' . $domainData['percent_2']
                 . ' 耗时3s请求数:' . $domainData['total_3'] . ',占比:' . $domainData['percent_3']
                 . ' 耗时5s请求数:' . $domainData['total_5'] . ',占比:' . $domainData['percent_5']
                 . ' 耗时10s请求数:' . $domainData['total_10'] . ',占比:' . $domainData['percent_10']
                 . ' 错误请求数:' . $domainData['total_error'] . ',占比:' . $domainData['percent_error']
                 . PHP_EOL
                 . '请求URI 总请求数 耗时1s请求数 耗时2s请求数 耗时3s请求数 耗时5s请求数 耗时10s请求数 错误请求数 耗时1s以上占比 耗时2s以上占比 耗时3s以上占比 耗时5s以上占比 耗时10s以上占比 错误请求占比'
                 . PHP_EOL;
    $errData = [];
    $needNum = 3;
    foreach ($domainData['uri_list'] as $uri => $uriData) {
        $errTag = $uri . '&' . $uriData['num_total'] . '&' . $uriData['percent_error'];
        $errData[$errTag] = $uriData['num_error'];
        $sheet->setCellValue('A' . $needNum, $uri)
            ->setCellValue('B' . $needNum, $uriData['num_total'])
            ->setCellValue('C' . $needNum, $uriData['num_1'])
            ->setCellValue('D' . $needNum, $uriData['num_2'])
            ->setCellValue('E' . $needNum, $uriData['num_3'])
            ->setCellValue('F' . $needNum, $uriData['num_5'])
            ->setCellValue('G' . $needNum, $uriData['num_10'])
            ->setCellValue('H' . $needNum, $uriData['num_error'])
            ->setCellValue('I' . $needNum, $uriData['percent_1'])
            ->setCellValue('J' . $needNum, $uriData['percent_2'])
            ->setCellValue('K' . $needNum, $uriData['percent_3'])
            ->setCellValue('L' . $needNum, $uriData['percent_5'])
            ->setCellValue('M' . $needNum, $uriData['percent_10'])
            ->setCellValue('N' . $needNum, $uriData['percent_error']);
        if ($needNum < 6) {
            $totalStr .= $uri . ' '
                         . $uriData['num_total'] . ' '
                         . $uriData['num_1']
                         . ' ' . $uriData['num_2']
                         . ' ' . $uriData['num_3']
                         . ' ' . $uriData['num_5']
                         . ' ' . $uriData['num_10']
                         . ' ' . $uriData['num_error']
                         . ' ' . $uriData['percent_1']
                         . ' ' . $uriData['percent_2']
                         . ' ' . $uriData['percent_3']
                         . ' ' . $uriData['percent_5']
                         . ' ' . $uriData['percent_10']
                         . ' ' . $uriData['percent_error']
                         . PHP_EOL;
        }
        ++$needNum;
    }

    arsort($errData, SORT_NUMERIC);
    $totalStr .= '请求URI 总请求数 错误请求数 错误请求占比' . PHP_EOL;
    $needNum2 = 0;
    foreach ($errData as $eKey => $eVal) {
        if ($needNum2 >= 3) {
            break;
        }

        $errList = explode('&', $eKey);
        $totalStr .= $errList[0] . ' '
                     . $errList[1] . ' '
                     . $eVal . ' '
                     . $errList[2] . PHP_EOL;
        ++$needNum2;
    }
    $totalStr .= PHP_EOL . PHP_EOL;
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save(__DIR__ . '/temp/log/nginx_report_temp/report-' . $domainData['domain'] . '-' . $date . '.xlsx');
}

$type = trim(\SyTool\Tool::getClientOption('-type', false, ''));
switch ($type) {
    case 'nginx':
        $date = trim(\SyTool\Tool::getClientOption('-date', false, ''));
        if (0 == strlen($date)) {
            exit('日期不能为空！');
        }
        if (8 != strlen($date)) {
            exit('日期不合法！');
        }
        if (!ctype_digit($date)) {
            exit('日期不合法！');
        }
        $domain = trim(\SyTool\Tool::getClientOption('-domain', false, ''));
        if (0 == strlen($domain)) {
            exit('域名不能为空！');
        }

        $totalContent = '';
        $domainData = transformNginxData($domain);
        createNginxExcel($domainData, $date, $totalContent);
        $totalFile = fopen(__DIR__ . '/temp/log/nginx_report_temp/report-all.txt', 'a');
        fwrite($totalFile, $totalContent);
        fclose($totalFile);

        break;
    default:
        exit('类型不支持！');
}
