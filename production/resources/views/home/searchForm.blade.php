<div class="search-form margin-top-20 padding-vertical-20">
    <form  action="#">
        <div class="select-wrapper clearfix">
            <div class="col-md-6">
                <div class="my-dropdown ake-dropdown">
                    {{ Form::select('year', $manufacturing_years, Request::input('year'),
                    ['class' => 'css-dropdowns', 'tabindex' => 1, 'placeholder' => 'All Years']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="my-dropdown ake-dropdown">
                    {{ Form::select('company', $companies, Request::input('company'),
              ['class' => 'css-dropdowns', 'tabindex' => 1, 'placeholder' => 'All Companies']) }}
                </div>
            </div>
        </div>
        <div class="select-wrapper clearfix">
            <div class="col-md-6">
                <div class="my-dropdown make-dropdown">
                    {{ Form::select('model', $models, Request::input('model'),
       ['class' => 'css-dropdowns', 'tabindex' => 1, 'placeholder' => 'All Models']) }}

                </div>
            </div>
            <div class="col-md-6">
                    <div class="my-dropdown make-dropdown">
                        {{ Form::select('body_type', $body_types, Request::input('body_type'),
                               ['class' => 'css-dropdowns', 'tabindex' => 1, 'placeholder' => 'All Body Styles']) }}
                    </div>
            </div>
        </div>
        <div class="select-wrapper clearfix">
            <div class="col-md-6">
                <div class="my-dropdown make-dropdown">
                    {{ Form::select('kilometer', $kilometers, Request::input('kilometer'),
                           ['class' => 'css-dropdowns', 'tabindex' => 1, 'placeholder' => 'All Mileage']) }}

                </div>
            </div>
            <div class="col-md-6">
                    <div class="my-dropdown make-dropdown">
                        {{ Form::select('transmission', ['automatic' => 'Automatic', 'manual'=> 'Manual'], Request::input('transmission'),
                                 ['class' => 'css-dropdowns', 'tabindex' => 1, 'placeholder' => 'All Transmissions']) }}

                    </div>
            </div>
        </div>
        <div class="select-wrapper clearfix">
            <div class="col-md-6">
                <div class="my-dropdown make-dropdown">
                    {{ Form::select('location', $city_of_registration, Request::input('location'),
          ['class' => 'css-dropdowns', 'tabindex' => 1, 'placeholder' => 'All Locations']) }}

                </div>
            </div>
            <div class="col-md-6">
                    <div class="my-dropdown make-dropdown">
                        {{ Form::select('price', $bid_starting_amounts, Request::input('price'),
         ['class' => 'css-dropdowns', 'tabindex' => 1, 'placeholder' => 'All Prices']) }}

                    </div>
            </div>
        </div>

        <div class="clear"></div>
        <div class="select-wrapper clearfix">
            <div class="form-element">
                <input type="checkbox" name="order_by" value="asc" id="check3">
                <label for="check3">Lowest price</label>
            </div>
            <div class="form-element">
                <input type="button" value="Find Auction " class="find_new_vehicle pull-right md-button">
            </div>
        </div>
    </form>
</div>