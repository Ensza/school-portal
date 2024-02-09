<?php

namespace App\DataTables;

use App\Models\Strand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class StrandsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query = Strand::with('track');
        return (new EloquentDataTable($query))
            ->addColumn('action', function(Strand $strand){
                return view('components.edit-delete-buttons',[
                    'row_id'=>$strand->id,'table_name'=>'tracks',
                    'disabled'=>false,
                ]);
            })
            ->addColumn('track', '{{$track["code"]}}')
            ->setRowId(function(Strand $strand){
                return "strand-id-$strand->id";
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Strand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('strands-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                            ->attr(['id'=>'reload-strands-btn'])
                    ])
                    ->postAjax(route('strands.data'))
                    ->lengthMenu([[10,25,50,100,-1],[10,25,50,100,'All']]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->addClass('text-nowrap'),
            Column::make('name')
                ->title('Strand name'),
            Column::make('code')
                ->title('Strand code'),
            Column::make('track')
                ->name('track.code') //allows for searchable column with relationship
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Strands_' . date('YmdHis');
    }
}
