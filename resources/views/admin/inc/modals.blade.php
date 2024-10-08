@include('admin.modals.create-trip')
@include('admin.modals.create-region')
@include('admin.modals.create-country')
@include('admin.modals.create-interest')
@include('admin.modals.create-wildlife')
@include('admin.modals.site-settings')

<!-- CRM Indication Modal -->
<div class="modal fade" id="crmIndicModal" tabindex="-1" role="dialog" aria-labelledby="crmIndicModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crmIndicModalLabel">CRM Indication</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You can write here information that you do not want to forget about how the CRM works and consult it
                    at any time.</p>
                <form method="POST" action="{{ route($route_prefix . 'updt-settings') }}">
                    @csrf
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="indication" id="" rows="10" class="form-control">
{!! $site_settings->indication !!}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn bg-gradient-dark w-100">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
