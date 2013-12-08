<tr>
    <td>@include('partials.links.opportunity', array('opportunity' => $opportunity))</td>
    <td>@include('partials.links.company', array('company' => $opportunity->company))</td>
    <td>{{ $opportunity->city }}</td>
    <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $opportunity->created_at)->diffForHumans(); }}</td>
    @if(Auth::user()->role == "Fellow")
        @if(PlacementStatus::hasPlacementStatus(Auth::user()->profile, $opportunity))
            <td>{{ PlacementStatus::getRecentPlacementStatus(Auth::user()->profile, $opportunity)->printWithDate() }}</td>
        @else
            {{-- TODO: Hide this button if a pitch has been submitted --}}
            <td><a data-toggle="modal" href="#pitch-modal-{{ $opportunity->id }}" class="btn btn-primary modal-btn">Pitch</a></td>
        @endif
    @endif
</tr>
<!-- Modal -->
<div class="modal" id="pitch-modal-{{ $opportunity->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="btn close btn-default" data-dismiss="modal">&times;</a>
                <h4 class="modal-title">Pitch for the {{ $opportunity->title }} Opportunity</h4>
            </div>
            <div class="modal-body">
                <h1>TODO: put a form here</h1>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-default" data-dismiss="modal">Cancel</a>
                <a href="" class="btn btn-primary placementStatus-submit">Submit</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->