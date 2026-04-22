@once
@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap');







    /* Select2 Overrides */
    .select2-container--default .select2-selection--single {
        height: 46px;
        border: 1.5px solid #dde1e7;
        border-radius: 10px;
        display: flex;
        align-items: center;
        padding: 0 12px;
        transition: border-color 0.2s;
    }

    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        outline: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: normal;
        color: #1a1a2e;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        padding: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 44px;
        right: 10px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #888 transparent transparent transparent;
    }

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #4f46e5 transparent;
    }

    .select2-dropdown {
        border: 1.5px solid #dde1e7;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        font-family: 'DM Sans', sans-serif;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1.5px solid #dde1e7;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.9rem;
        font-family: 'DM Sans', sans-serif;
        outline: none;
        transition: border-color 0.2s;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
        border-color: #4f46e5;
    }

    .select2-results__option {
        font-size: 0.9rem;
        padding: 9px 14px;
        color: #1a1a2e;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background: #4f46e5;
        color: #fff;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background: #eef2ff;
        color: #4f46e5;
        font-weight: 500;
    }

    .select2-results__option-group {
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #999;
        padding: 10px 14px 4px;
    }

    .select2-container {
        width: 100% !important;
    }

    .hint {
        font-size: 0.78rem;
        color: #aaa;
        margin-top: 0.6rem;
    }
</style>
@endpush
@endOnce

<label for="country_code">Country</label>

<select id="country_code" class="form-select" required>

    <!-- Nepal first -->
    <option value="+977" selected>🇳🇵 Nepal (+977)</option>

    <optgroup label="South Asia">
        <option value="+91">🇮🇳 India (+91)</option>
        <option value="+880">🇧🇩 Bangladesh (+880)</option>
        <option value="+94">🇱🇰 Sri Lanka (+94)</option>
        <option value="+92">🇵🇰 Pakistan (+92)</option>
        <option value="+93">🇦🇫 Afghanistan (+93)</option>
        <option value="+975">🇧🇹 Bhutan (+975)</option>
        <option value="+960">🇲🇻 Maldives (+960)</option>
    </optgroup>

    <optgroup label="Southeast Asia">
        <option value="+66">🇹🇭 Thailand (+66)</option>
        <option value="+60">🇲🇾 Malaysia (+60)</option>
        <option value="+65">🇸🇬 Singapore (+65)</option>
        <option value="+62">🇮🇩 Indonesia (+62)</option>
        <option value="+84">🇻🇳 Vietnam (+84)</option>
        <option value="+63">🇵🇭 Philippines (+63)</option>
        <option value="+95">🇲🇲 Myanmar (+95)</option>
        <option value="+855">🇰🇭 Cambodia (+855)</option>
        <option value="+856">🇱🇦 Laos (+856)</option>
        <option value="+673">🇧🇳 Brunei (+673)</option>
        <option value="+670">🇹🇱 Timor-Leste (+670)</option>
    </optgroup>

    <optgroup label="East Asia">
        <option value="+86">🇨🇳 China (+86)</option>
        <option value="+81">🇯🇵 Japan (+81)</option>
        <option value="+82">🇰🇷 South Korea (+82)</option>
        <option value="+850">🇰🇵 North Korea (+850)</option>
        <option value="+886">🇹🇼 Taiwan (+886)</option>
        <option value="+852">🇭🇰 Hong Kong (+852)</option>
        <option value="+853">🇲🇴 Macau (+853)</option>
        <option value="+976">🇲🇳 Mongolia (+976)</option>
    </optgroup>

    <optgroup label="Central Asia">
        <option value="+7">🇰🇿 Kazakhstan (+7)</option>
        <option value="+996">🇰🇬 Kyrgyzstan (+996)</option>
        <option value="+992">🇹🇯 Tajikistan (+992)</option>
        <option value="+993">🇹🇲 Turkmenistan (+993)</option>
        <option value="+998">🇺🇿 Uzbekistan (+998)</option>
    </optgroup>

    <optgroup label="Middle East / Gulf">
        <option value="+971">🇦🇪 UAE (+971)</option>
        <option value="+966">🇸🇦 Saudi Arabia (+966)</option>
        <option value="+974">🇶🇦 Qatar (+974)</option>
        <option value="+973">🇧🇭 Bahrain (+973)</option>
        <option value="+968">🇴🇲 Oman (+968)</option>
        <option value="+965">🇰🇼 Kuwait (+965)</option>
        <option value="+964">🇮🇶 Iraq (+964)</option>
        <option value="+98">🇮🇷 Iran (+98)</option>
        <option value="+972">🇮🇱 Israel (+972)</option>
        <option value="+970">🇵🇸 Palestine (+970)</option>
        <option value="+962">🇯🇴 Jordan (+962)</option>
        <option value="+961">🇱🇧 Lebanon (+961)</option>
        <option value="+963">🇸🇾 Syria (+963)</option>
        <option value="+967">🇾🇪 Yemen (+967)</option>
    </optgroup>

    <optgroup label="Western Europe">
        <option value="+44">🇬🇧 UK (+44)</option>
        <option value="+49">🇩🇪 Germany (+49)</option>
        <option value="+33">🇫🇷 France (+33)</option>
        <option value="+39">🇮🇹 Italy (+39)</option>
        <option value="+34">🇪🇸 Spain (+34)</option>
        <option value="+31">🇳🇱 Netherlands (+31)</option>
        <option value="+32">🇧🇪 Belgium (+32)</option>
        <option value="+41">🇨🇭 Switzerland (+41)</option>
        <option value="+43">🇦🇹 Austria (+43)</option>
        <option value="+351">🇵🇹 Portugal (+351)</option>
        <option value="+353">🇮🇪 Ireland (+353)</option>
        <option value="+352">🇱🇺 Luxembourg (+352)</option>
        <option value="+377">🇲🇨 Monaco (+377)</option>
        <option value="+376">🇦🇩 Andorra (+376)</option>
        <option value="+354">🇮🇸 Iceland (+354)</option>
    </optgroup>

    <optgroup label="Northern Europe">
        <option value="+46">🇸🇪 Sweden (+46)</option>
        <option value="+47">🇳🇴 Norway (+47)</option>
        <option value="+45">🇩🇰 Denmark (+45)</option>
        <option value="+358">🇫🇮 Finland (+358)</option>
        <option value="+372">🇪🇪 Estonia (+372)</option>
        <option value="+371">🇱🇻 Latvia (+371)</option>
        <option value="+370">🇱🇹 Lithuania (+370)</option>
    </optgroup>

    <optgroup label="Southern Europe">
        <option value="+30">🇬🇷 Greece (+30)</option>
        <option value="+385">🇭🇷 Croatia (+385)</option>
        <option value="+381">🇷🇸 Serbia (+381)</option>
        <option value="+387">🇧🇦 Bosnia (+387)</option>
        <option value="+382">🇲🇪 Montenegro (+382)</option>
        <option value="+389">🇲🇰 North Macedonia (+389)</option>
        <option value="+355">🇦🇱 Albania (+355)</option>
        <option value="+386">🇸🇮 Slovenia (+386)</option>
        <option value="+383">🇽🇰 Kosovo (+383)</option>
        <option value="+356">🇲🇹 Malta (+356)</option>
        <option value="+357">🇨🇾 Cyprus (+357)</option>
    </optgroup>

    <optgroup label="Eastern Europe">
        <option value="+48">🇵🇱 Poland (+48)</option>
        <option value="+420">🇨🇿 Czech Republic (+420)</option>
        <option value="+421">🇸🇰 Slovakia (+421)</option>
        <option value="+36">🇭🇺 Hungary (+36)</option>
        <option value="+40">🇷🇴 Romania (+40)</option>
        <option value="+359">🇧🇬 Bulgaria (+359)</option>
        <option value="+380">🇺🇦 Ukraine (+380)</option>
        <option value="+375">🇧🇾 Belarus (+375)</option>
        <option value="+373">🇲🇩 Moldova (+373)</option>
        <option value="+7">🇷🇺 Russia (+7)</option>
    </optgroup>

    <optgroup label="Caucasus">
        <option value="+995">🇬🇪 Georgia (+995)</option>
        <option value="+374">🇦🇲 Armenia (+374)</option>
        <option value="+994">🇦🇿 Azerbaijan (+994)</option>
    </optgroup>

    <optgroup label="North Africa">
        <option value="+20">🇪🇬 Egypt (+20)</option>
        <option value="+212">🇲🇦 Morocco (+212)</option>
        <option value="+213">🇩🇿 Algeria (+213)</option>
        <option value="+216">🇹🇳 Tunisia (+216)</option>
        <option value="+218">🇱🇾 Libya (+218)</option>
        <option value="+249">🇸🇩 Sudan (+249)</option>
    </optgroup>

    <optgroup label="West Africa">
        <option value="+234">🇳🇬 Nigeria (+234)</option>
        <option value="+233">🇬🇭 Ghana (+233)</option>
        <option value="+225">🇨🇮 Côte d'Ivoire (+225)</option>
        <option value="+221">🇸🇳 Senegal (+221)</option>
        <option value="+223">🇲🇱 Mali (+223)</option>
        <option value="+226">🇧🇫 Burkina Faso (+226)</option>
        <option value="+224">🇬🇳 Guinea (+224)</option>
        <option value="+222">🇲🇷 Mauritania (+222)</option>
        <option value="+220">🇬🇲 Gambia (+220)</option>
        <option value="+232">🇸🇱 Sierra Leone (+232)</option>
        <option value="+231">🇱🇷 Liberia (+231)</option>
        <option value="+229">🇧🇯 Benin (+229)</option>
        <option value="+228">🇹🇬 Togo (+228)</option>
        <option value="+227">🇳🇪 Niger (+227)</option>
        <option value="+245">🇬🇼 Guinea-Bissau (+245)</option>
        <option value="+238">🇨🇻 Cape Verde (+238)</option>
    </optgroup>

    <optgroup label="East Africa">
        <option value="+254">🇰🇪 Kenya (+254)</option>
        <option value="+255">🇹🇿 Tanzania (+255)</option>
        <option value="+256">🇺🇬 Uganda (+256)</option>
        <option value="+251">🇪🇹 Ethiopia (+251)</option>
        <option value="+252">🇸🇴 Somalia (+252)</option>
        <option value="+253">🇩🇯 Djibouti (+253)</option>
        <option value="+250">🇷🇼 Rwanda (+250)</option>
        <option value="+257">🇧🇮 Burundi (+257)</option>
        <option value="+258">🇲🇿 Mozambique (+258)</option>
        <option value="+260">🇿🇲 Zambia (+260)</option>
        <option value="+263">🇿🇼 Zimbabwe (+263)</option>
        <option value="+265">🇲🇼 Malawi (+265)</option>
        <option value="+291">🇪🇷 Eritrea (+291)</option>
        <option value="+248">🇸🇨 Seychelles (+248)</option>
        <option value="+230">🇲🇺 Mauritius (+230)</option>
        <option value="+261">🇲🇬 Madagascar (+261)</option>
        <option value="+269">🇰🇲 Comoros (+269)</option>
    </optgroup>

    <optgroup label="Central Africa">
        <option value="+243">🇨🇩 DR Congo (+243)</option>
        <option value="+242">🇨🇬 Congo (+242)</option>
        <option value="+237">🇨🇲 Cameroon (+237)</option>
        <option value="+236">🇨🇫 Central African Republic (+236)</option>
        <option value="+235">🇹🇩 Chad (+235)</option>
        <option value="+240">🇬🇶 Equatorial Guinea (+240)</option>
        <option value="+241">🇬🇦 Gabon (+241)</option>
        <option value="+239">🇸🇹 São Tomé &amp; Príncipe (+239)</option>
    </optgroup>

    <optgroup label="Southern Africa">
        <option value="+27">🇿🇦 South Africa (+27)</option>
        <option value="+264">🇳🇦 Namibia (+264)</option>
        <option value="+267">🇧🇼 Botswana (+267)</option>
        <option value="+268">🇸🇿 Eswatini (+268)</option>
        <option value="+266">🇱🇸 Lesotho (+266)</option>
        <option value="+244">🇦🇴 Angola (+244)</option>
    </optgroup>

    <optgroup label="North America">
        <option value="+1">🇺🇸 USA (+1)</option>
        <option value="+1">🇨🇦 Canada (+1)</option>
        <option value="+52">🇲🇽 Mexico (+52)</option>
    </optgroup>

    <optgroup label="Central America &amp; Caribbean">
        <option value="+502">🇬🇹 Guatemala (+502)</option>
        <option value="+503">🇸🇻 El Salvador (+503)</option>
        <option value="+504">🇭🇳 Honduras (+504)</option>
        <option value="+505">🇳🇮 Nicaragua (+505)</option>
        <option value="+506">🇨🇷 Costa Rica (+506)</option>
        <option value="+507">🇵🇦 Panama (+507)</option>
        <option value="+501">🇧🇿 Belize (+501)</option>
        <option value="+53">🇨🇺 Cuba (+53)</option>
        <option value="+1">🇯🇲 Jamaica (+1)</option>
        <option value="+1">🇹🇹 Trinidad &amp; Tobago (+1)</option>
        <option value="+1">🇧🇧 Barbados (+1)</option>
        <option value="+1">🇧🇸 Bahamas (+1)</option>
        <option value="+1">🇩🇴 Dominican Republic (+1)</option>
        <option value="+509">🇭🇹 Haiti (+509)</option>
        <option value="+1">🇵🇷 Puerto Rico (+1)</option>
        <option value="+1">🇦🇬 Antigua &amp; Barbuda (+1)</option>
        <option value="+1">🇩🇲 Dominica (+1)</option>
        <option value="+1">🇬🇩 Grenada (+1)</option>
        <option value="+1">🇰🇳 Saint Kitts &amp; Nevis (+1)</option>
        <option value="+1">🇱🇨 Saint Lucia (+1)</option>
        <option value="+1">🇻🇨 Saint Vincent (+1)</option>
        <option value="+590">🇬🇵 Guadeloupe (+590)</option>
        <option value="+596">🇲🇶 Martinique (+596)</option>
        <option value="+599">🇨🇼 Curaçao (+599)</option>
    </optgroup>

    <optgroup label="South America">
        <option value="+55">🇧🇷 Brazil (+55)</option>
        <option value="+54">🇦🇷 Argentina (+54)</option>
        <option value="+56">🇨🇱 Chile (+56)</option>
        <option value="+57">🇨🇴 Colombia (+57)</option>
        <option value="+58">🇻🇪 Venezuela (+58)</option>
        <option value="+51">🇵🇪 Peru (+51)</option>
        <option value="+593">🇪🇨 Ecuador (+593)</option>
        <option value="+591">🇧🇴 Bolivia (+591)</option>
        <option value="+595">🇵🇾 Paraguay (+595)</option>
        <option value="+598">🇺🇾 Uruguay (+598)</option>
        <option value="+592">🇬🇾 Guyana (+592)</option>
        <option value="+597">🇸🇷 Suriname (+597)</option>
        <option value="+594">🇬🇫 French Guiana (+594)</option>
    </optgroup>

    <optgroup label="Oceania">
        <option value="+61">🇦🇺 Australia (+61)</option>
        <option value="+64">🇳🇿 New Zealand (+64)</option>
        <option value="+675">🇵🇬 Papua New Guinea (+675)</option>
        <option value="+679">🇫🇯 Fiji (+679)</option>
        <option value="+676">🇹🇴 Tonga (+676)</option>
        <option value="+685">🇼🇸 Samoa (+685)</option>
        <option value="+677">🇸🇧 Solomon Islands (+677)</option>
        <option value="+678">🇻🇺 Vanuatu (+678)</option>
        <option value="+686">🇰🇮 Kiribati (+686)</option>
        <option value="+692">🇲🇭 Marshall Islands (+692)</option>
        <option value="+691">🇫🇲 Micronesia (+691)</option>
        <option value="+680">🇵🇼 Palau (+680)</option>
        <option value="+674">🇳🇷 Nauru (+674)</option>
        <option value="+688">🇹🇻 Tuvalu (+688)</option>
        <option value="+687">🇳🇨 New Caledonia (+687)</option>
        <option value="+689">🇵🇫 French Polynesia (+689)</option>
    </optgroup>

</select>

@once
@push('scripts')


<!-- jQuery (required by Select2) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#country_code').select2({
            placeholder: 'Search country...',
            allowClear: false,
            width: '100%',
            templateResult: formatCountry,
            templateSelection: formatCountry,
            matcher: customMatcher
        });

        // Custom formatter — shows flag + name nicely
        function formatCountry(option) {
            if (!option.id) return option.text;
            return $('<span style="font-size:0.95rem">' + option.text + '</span>');
        }

        // Custom matcher: search by both text and dial code
        function customMatcher(params, data) {
            if ($.trim(params.term) === '') return data;
            if (typeof data.text === 'undefined') return null;

            const term = params.term.toLowerCase();
            const text = data.text.toLowerCase();

            // Match country name or dial code number
            if (text.indexOf(term) > -1) return data;
            if (data.id && data.id.replace('+', '').startsWith(term.replace('+', ''))) return data;

            return null;
        }
    });
</script>
@endpush
@endOnce