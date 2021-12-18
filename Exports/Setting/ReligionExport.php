<?php

namespace Modules\Contact\Exports\Setting;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Modules\Core\Abstracts\Export\FastExcelExport;
use Modules\Core\Models\Setting\Permission;
use Modules\Contact\Models\Setting\Religion;

/**
 * @class ReligionExport
 * @package Modules\Contact\Exports\Setting
 */
class ReligionExport extends FastExcelExport
{
    /**
     * ReligionExport constructor.
     *
     * @param null $data
     * @throws InvalidArgumentException
     */
    public function __construct($data = null)
    {
        parent::__construct();

        $this->data($data);
    }

    /**
     * @param Religion $row
     * @return array
     */
    public function map($row): array
    {
        $this->formatRow = [
            '#' => $row->id,
            'Name' => $row->name,
            'Remarks' => $row->remarks,
            'Additional Info' => json_encode($row->additional_info),
            'Enabled' => ucfirst($row->enabled),
            'Created' => $row->created_at->format(config('app.datetime')),
            'Updated' => $row->updated_at->format(config('app.datetime'))
        ];

        $this->getSupperAdminColumns($row);

        return $this->formatRow;
    }
}

