<?php

$puzzle = [
    [5, 3, 0, 0, 7, 0, 0, 0, 0],
    [6, 0, 0, 1, 9, 5, 0, 0, 0],
    [0, 9, 8, 0, 0, 0, 0, 6, 0],
    [8, 0, 0, 0, 6, 0, 0, 0, 3],
    [4, 0, 0, 8, 0, 3, 0, 0, 1],
    [7, 0, 0, 0, 2, 0, 0, 0, 6],
    [0, 6, 0, 0, 0, 0, 2, 8, 0],
    [0, 0, 0, 4, 1, 9, 0, 0, 5],
    [0, 0, 0, 0, 8, 0, 0, 7, 9],
];

$i = 0;
do {
    [$puzzle, $solved] = solve($puzzle);

    $i++;
} while (!$solved);

printPuzzle($puzzle);

function printPuzzle($puzzle)
{
    foreach ($puzzle as $rows) {
        foreach ($rows as $column) {
            echo $column . ' ';
        }

        echo PHP_EOL;
    }
}

function solve($puzzle)
{
    $solved = true;

    foreach ($puzzle as $row => $data) {
        foreach ($data as $column => $value) {
            if ($value !== 0) {
                continue;
            }

            $solved = false;

            $values = range(1, 9);

            $values = removeValues($values, resolveColumn($puzzle, $column));

            $values = removeValues($values, resolveRow($puzzle, $row));
            $values = removeValues($values, resolveSquare($puzzle, $column, $row));

            if (count($values) !== 1) {
                continue;
            }

            $puzzle[$row][$column] = array_pop($values);
        }
    }

    return [$puzzle, $solved];
}

function resolveSquare($puzzle, $column, $row)
{
    $square = 0;

    if ($row >= 6) {
        $square = 6;
    } elseif ($row >= 3) {
        $square = 3;
    }

    if ($column >= 6) {
        $square += 3;
    } elseif ($column >= 3) {
        $square += 2;
    } else {
        $square += 1;
    }

    switch ($square) {
        case 1:
            $columns = $rows = range(0, 2);
            break;
        case 2:
            $columns = range(3, 5);
            $rows = range(0, 2);
            break;
        case 3:
            $columns = range(6, 8);
            $rows = range(0, 2);
            break;
        case 4:
            $columns = range(0, 2);
            $rows = range(3, 5);
            break;
        case 5:
            $columns = range(3, 5);
            $rows = range(3, 5);
            break;
        case 6:
            $columns = range(6, 8);
            $rows = range(3, 5);
            break;
        case 7:
            $columns = range(0, 2);
            $rows = range(6, 8);
            break;
        case 8:
            $columns = range(3, 5);
            $rows = range(6, 8);
            break;
        case 9:
            $columns = range(6, 8);
            $rows = range(6, 8);
            break;
        default:
            echo $square;
            die();
    }

    $values = [];

    foreach ($columns as $column2) {
        foreach ($rows as $row2) {
            $v = $puzzle[$row2][$column2];

            if ($v === 0) {
                continue;
            }

            $values[] = $v;
        }
    }

    return $values;
}

function resolveRow($puzzle, $row)
{
    $values = [];

    foreach ($puzzle as $row2 => $data) {
        if ($row2 !== $row) {
            continue;
        }

        foreach ($data as $column2 => $value) {
            if ($value !== 0) {
                $values[] = $value;
            }
        }
    }

    return $values;
}

function resolveColumn($puzzle, $column)
{
    $values = [];

    foreach ($puzzle as $row => $data) {
        foreach ($data as $column2 => $value) {
            if ($column2 !== $column) {
                continue;
            }

            if ($value !== 0) {
                $values[] = $value;
            }
        }
    }

    return $values;
}

function removeValues($values, $notThese)
{
    $newValues = [];

    foreach ($values as $value) {
        if (in_array($value, $notThese)) {
            continue;
        }

        $newValues[] = $value;
    }

    return $newValues;
}