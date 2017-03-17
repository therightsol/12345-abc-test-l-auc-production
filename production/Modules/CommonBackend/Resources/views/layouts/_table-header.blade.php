<div class="row form" style="display: flex; align-items: center">
    <div class="col-sm-9">
        <div class="dataTables_length no-margin" id="country_table_length">
            <label>
                <select id="filter-limit-select"
                             name="limit" aria-controls="country_table" class="">
                    <option value="10" @if($obj->perPage() == 10) selected @endif >10</option>
                    <option value="25" @if($obj->perPage() == 25) selected @endif>25</option>
                    <option value="50" @if($obj->perPage() == 50) selected @endif>50</option>
                    <option value="100" @if($obj->perPage() == 100) selected @endif>100</option>
                </select> Per Page
            </label>
        </div>
    </div>
    <div class="col-sm-3">
        <div id="country_table_filter ">
            <div class="form-group floating-label">
                <input id="filter-table-searchInput" class="form-control" type="search" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" >
                <label for="">Search</label>
                <button style="    position: absolute;
    right: 9px;
    top: 16px;" id="filter-table-button" class="btn btn-icon-toggle ink-reaction" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <input id="filter-tableName-input" type="hidden" name="table" value="{{ isset($_GET['table']) ? $_GET['table'] : '' }}">
            <input id="filter-tableOrder-input" type="hidden" name="order" value="{{ isset($_GET['order']) ? $_GET['order'] : '' }}">


        </div>
    </div>
</div>