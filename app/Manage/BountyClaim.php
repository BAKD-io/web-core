<?php

namespace BAKD\Manage;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\HasMany;;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class BountyClaim extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'BAKD\BountyClaim';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'confirmed', 'description', 'uuid'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),
            HasOne::make('User', 'user')->exceptOnForms()->sortable(),
            Markdown::make('Claim Description', 'description')->sortable(),
            HasOne::make('Bounty')->exceptOnForms()->sortable(),
            Select::make('Status', 'confirmed')->options([
                '0' => 'Pending',
                '1' => 'Approved',
                '2' => 'Rejected'
            ])->displayUsingLabels()->sortable(),
            Text::make('Claim UUID', 'uuid')->sortable()->onlyOnDetail(),
            HasMany::make('BountyClaimAttachment', 'attachments')->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Bounty Claims';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Bounty Claim';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->user->name . ' | ' . $this->bounty->name . ' (Bounty ID #' . $this->id . ')';
    }

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle()
    {
        return 'BAKD Bounty Claim Submissions';
    }
}
