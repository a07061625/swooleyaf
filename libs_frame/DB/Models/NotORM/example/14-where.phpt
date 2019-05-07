--TEST--
WHERE
--FILE--
<?php
include_once dirname(__FILE__) . '/connect.inc.php';

foreach ([
    $software->application('id', 4),
    $software->application('id < ?', 4),
    $software->application('id < ?', [4]),
    $software->application('id', [1, 2]),
    $software->application('id', null),
    $software->application('id', $software->application()),
    $software->application('id < ?', 4)->where('maintainer_id IS NOT NULL'),
    $software->application(['id < ?' => 4, 'author_id' => 12]),
] as $result) {
    echo implode(', ', array_keys(iterator_to_array($result->order('id')))) . "\n"; // aggregation("GROUP_CONCAT(id)") is not available in all drivers
}
?>
--EXPECTF--
4
1, 2, 3
1, 2, 3
1, 2

1, 2, 3, 4
1, 3
3
