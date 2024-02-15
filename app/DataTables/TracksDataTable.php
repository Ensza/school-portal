<?php

namespace App\DataTables;

use App\Models\Track;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TracksDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query = Track::with('strands'); //make $query a relationship
        return (new EloquentDataTable($query))
            ->addColumn('action', function(Track $track){
                $table_name = 'tracks';
                return view('components.edit-delete-buttons',[
                    'row_id'=>$track->id,
                    'table_name'=>$table_name,
                    'disabled'=>$track->strands->count()>0 ? true : false,
                    'tooltip_message'=>'Tracks with at least one strand under cannot be deleted',
                    'edit_attr'=>'',
                    'del_attr'=>'',
                    'script'=>"
                        tooltipTriggerList = $('.$table_name-delete-disabled');
                        tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                    "
                ]);
            })
            ->addColumn('strands-count', '{{count($strands)}}') //return the strands count as content for column
            ->setRowId(function(Track $track){
                return "tracks-id-$track->id";
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Track $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tracks-table')
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
                            ->attr([
                                'id'=>'reload-tracks-btn'
                            ])
                    ])
                    ->postAjax(route('tracks.data'))
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
                ->title('Track name'),
            Column::make('code')
                ->title('Track code'),
            Column::computed('strands-count')
                ->title('Strands #')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Tracks_' . date('YmdHis');
    }
}
