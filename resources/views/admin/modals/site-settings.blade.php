<!-- Modal -->
<div class="modal fade" id="siteSettingsModal" tabindex="-1" role="dialog" aria-labelledby="siteSettingsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siteSettingsModalLabel">Site Settings</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="{{ route('dashboard') . '#logo' }}" class="btn btn-info">Site Logo
                    <bi class="bi-gear-wide-connected"></bi>
                </a>
                <form method="POST" action="{{ route($route_prefix . 'updt-settings') }}">
                    @csrf
                    <div class="form-group">
                        <label for="">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="" placeholder=""
                            value="{{ $site_name }}">
                    </div>
                    <div class="form-group">
                        <label for="">Contact Email</label>
                        <input type="email" name="email" value="{{ $site_settings ? $site_settings->email : '' }}"
                            class="form-control" id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="tel" name="phone" value="{{ $site_settings ? $site_settings->phone : '' }}"
                            class="form-control" id="" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="">International Phone</label>
                        <input type="tel" name="international_phone"
                            value="{{ $site_settings ? $site_settings->international_phonr : '' }}" class="form-control"
                            id="" placeholder="Optional" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Fax</label>
                        <input type="tel" name="fax" value="{{ $site_settings ? $site_settings->fax : '' }}"
                            class="form-control" id="" placeholder="Optional" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" id="" rows="2" class="form-control">{{ $site_settings ? $site_settings->address : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Availability</label>
                        <textarea name="availability" id="" rows="2" class="form-control">{{ $site_settings ? $site_settings->availability : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn bg-gradient-dark w-100">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
