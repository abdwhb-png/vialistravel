<template>
    <div trip-finder="wrapper" js-trip-finder>
        <div trip-finder="stage">
            <input
                dropdown="toggle"
                id="dropdown-reset"
                name="trip-finder-dropdown"
                type="radio"
            />
            <!-- REGIONS -->
            <input
                dropdown="toggle"
                id="dropdown-regions"
                name="trip-finder-dropdown"
                type="radio"
            />
            <div
                id="regions-dropdown"
                trip-finder="dropdown"
                class="js-dropdown"
            >
                <label for="dropdown-regions" trip-finder="label"
                    >By Region</label
                >
                <label for="dropdown-reset" trip-finder="label reset"
                    >By Region</label
                >
                <ul trip-finder="list" enso>
                    <li
                        v-for="(item, index) in regions"
                        :key="index"
                        trip-finder="item"
                        :trip-finder-link="item.permalink"
                        @click="search.country = item"
                        :id="'region-' + item.id"
                    >
                        {{ item.title }}
                    </li>
                </ul>
            </div>
            <!-- COUNTRIES -->
            <input
                dropdown="toggle"
                id="dropdown-countries"
                name="trip-finder-dropdown"
                type="radio"
            />
            <div
                id="countries-dropdown"
                trip-finder="dropdown"
                class="js-dropdown"
            >
                <label for="dropdown-countries" trip-finder="label"
                    >By Country</label
                >
                <label for="dropdown-reset" trip-finder="label reset"
                    >By Country</label
                >
                <ul trip-finder="list" enso>
                    <li
                        v-for="(item, index) in countries"
                        :key="index"
                        trip-finder="item"
                        :trip-finder-link="item.permalink"
                        :id="'country-' + item.id"
                    >
                        {{ item.title }}
                    </li>
                </ul>
            </div>
            <!-- WILDLIFE -->
            <input
                dropdown="toggle"
                id="dropdown-wildlife"
                name="trip-finder-dropdown"
                type="radio"
            />
            <div
                id="wildlife-dropdown"
                trip-finder="dropdown"
                class="js-dropdown"
            >
                <label for="dropdown-wildlife" trip-finder="label"
                    >By Wildlife</label
                >
                <label for="dropdown-reset" trip-finder="label reset"
                    >By Wildlife</label
                >
                <ul trip-finder="list" enso>
                    <li
                        v-for="(item, index) in wildlives"
                        :key="index"
                        trip-finder="item"
                        :trip-finder-link="item.permalink"
                        :id="'wildlife-' + item.id"
                    >
                        {{ item.title }}
                    </li>
                </ul>
            </div>
            <!-- INTERESTS -->
            <input
                dropdown="toggle"
                id="dropdown-interest"
                name="trip-finder-dropdown"
                type="radio"
            />
            <div
                id="interest-dropdown"
                trip-finder="dropdown"
                class="js-dropdown"
            >
                <label for="dropdown-interest" trip-finder="label"
                    >By Interest</label
                >
                <label for="dropdown-reset" trip-finder="label reset"
                    >By Interest</label
                >
                <ul trip-finder="list" enso>
                    <li
                        v-for="(item, index) in interests"
                        :key="index"
                        trip-finder="item"
                        :trip-finder-link="item.permalink"
                        :id="'interest-' + item.id"
                    >
                        {{ item.title }}
                    </li>
                </ul>
            </div>
            <!-- START DATE -->
            <div trip-finder="date">
                <div
                    trip-finder-date="placeholder"
                    class="js-placeholder-start"
                >
                    Start Date
                </div>
                <input
                    id="dropdown-start-date"
                    trip-finder-date="input"
                    type="date"
                    class="js-datepicker-start"
                />
                <svg
                    class="icon-calendar"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 37 37"
                >
                    <path
                        d="M20 23.333Q19.292 23.333 18.812 22.854Q18.333 22.375 18.333 21.667Q18.333 20.958 18.812 20.479Q19.292 20 20 20Q20.708 20 21.188 20.479Q21.667 20.958 21.667 21.667Q21.667 22.375 21.188 22.854Q20.708 23.333 20 23.333ZM13.333 23.333Q12.625 23.333 12.146 22.854Q11.667 22.375 11.667 21.667Q11.667 20.958 12.146 20.479Q12.625 20 13.333 20Q14.042 20 14.521 20.479Q15 20.958 15 21.667Q15 22.375 14.521 22.854Q14.042 23.333 13.333 23.333ZM26.667 23.333Q25.958 23.333 25.479 22.854Q25 22.375 25 21.667Q25 20.958 25.479 20.479Q25.958 20 26.667 20Q27.375 20 27.854 20.479Q28.333 20.958 28.333 21.667Q28.333 22.375 27.854 22.854Q27.375 23.333 26.667 23.333ZM20 30Q19.292 30 18.812 29.521Q18.333 29.042 18.333 28.333Q18.333 27.625 18.812 27.146Q19.292 26.667 20 26.667Q20.708 26.667 21.188 27.146Q21.667 27.625 21.667 28.333Q21.667 29.042 21.188 29.521Q20.708 30 20 30ZM13.333 30Q12.625 30 12.146 29.521Q11.667 29.042 11.667 28.333Q11.667 27.625 12.146 27.146Q12.625 26.667 13.333 26.667Q14.042 26.667 14.521 27.146Q15 27.625 15 28.333Q15 29.042 14.521 29.521Q14.042 30 13.333 30ZM26.667 30Q25.958 30 25.479 29.521Q25 29.042 25 28.333Q25 27.625 25.479 27.146Q25.958 26.667 26.667 26.667Q27.375 26.667 27.854 27.146Q28.333 27.625 28.333 28.333Q28.333 29.042 27.854 29.521Q27.375 30 26.667 30ZM7.792 36.667Q6.667 36.667 5.833 35.833Q5 35 5 33.875V8.875Q5 7.75 5.833 6.938Q6.667 6.125 7.792 6.125H10.125V3.333H13.042V6.125H26.958V3.333H29.875V6.125H32.208Q33.333 6.125 34.167 6.938Q35 7.75 35 8.875V33.875Q35 35 34.167 35.833Q33.333 36.667 32.208 36.667ZM7.792 33.875H32.208Q32.208 33.875 32.208 33.875Q32.208 33.875 32.208 33.875V16.375H7.792V33.875Q7.792 33.875 7.792 33.875Q7.792 33.875 7.792 33.875ZM7.792 13.625H32.208V8.875Q32.208 8.875 32.208 8.875Q32.208 8.875 32.208 8.875H7.792Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875ZM7.792 13.625V8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875V13.625Z"
                    />
                </svg>
            </div>
            <!-- END DATE -->
            <div trip-finder="date">
                <div trip-finder-date="placeholder" class="js-placeholder-end">
                    End Date
                </div>
                <input
                    id="dropdown-end-date"
                    trip-finder-date="input"
                    type="date"
                    class="js-datepicker-end"
                />
                <svg
                    class="icon-calendar"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 37 37"
                >
                    <path
                        d="M20 23.333Q19.292 23.333 18.812 22.854Q18.333 22.375 18.333 21.667Q18.333 20.958 18.812 20.479Q19.292 20 20 20Q20.708 20 21.188 20.479Q21.667 20.958 21.667 21.667Q21.667 22.375 21.188 22.854Q20.708 23.333 20 23.333ZM13.333 23.333Q12.625 23.333 12.146 22.854Q11.667 22.375 11.667 21.667Q11.667 20.958 12.146 20.479Q12.625 20 13.333 20Q14.042 20 14.521 20.479Q15 20.958 15 21.667Q15 22.375 14.521 22.854Q14.042 23.333 13.333 23.333ZM26.667 23.333Q25.958 23.333 25.479 22.854Q25 22.375 25 21.667Q25 20.958 25.479 20.479Q25.958 20 26.667 20Q27.375 20 27.854 20.479Q28.333 20.958 28.333 21.667Q28.333 22.375 27.854 22.854Q27.375 23.333 26.667 23.333ZM20 30Q19.292 30 18.812 29.521Q18.333 29.042 18.333 28.333Q18.333 27.625 18.812 27.146Q19.292 26.667 20 26.667Q20.708 26.667 21.188 27.146Q21.667 27.625 21.667 28.333Q21.667 29.042 21.188 29.521Q20.708 30 20 30ZM13.333 30Q12.625 30 12.146 29.521Q11.667 29.042 11.667 28.333Q11.667 27.625 12.146 27.146Q12.625 26.667 13.333 26.667Q14.042 26.667 14.521 27.146Q15 27.625 15 28.333Q15 29.042 14.521 29.521Q14.042 30 13.333 30ZM26.667 30Q25.958 30 25.479 29.521Q25 29.042 25 28.333Q25 27.625 25.479 27.146Q25.958 26.667 26.667 26.667Q27.375 26.667 27.854 27.146Q28.333 27.625 28.333 28.333Q28.333 29.042 27.854 29.521Q27.375 30 26.667 30ZM7.792 36.667Q6.667 36.667 5.833 35.833Q5 35 5 33.875V8.875Q5 7.75 5.833 6.938Q6.667 6.125 7.792 6.125H10.125V3.333H13.042V6.125H26.958V3.333H29.875V6.125H32.208Q33.333 6.125 34.167 6.938Q35 7.75 35 8.875V33.875Q35 35 34.167 35.833Q33.333 36.667 32.208 36.667ZM7.792 33.875H32.208Q32.208 33.875 32.208 33.875Q32.208 33.875 32.208 33.875V16.375H7.792V33.875Q7.792 33.875 7.792 33.875Q7.792 33.875 7.792 33.875ZM7.792 13.625H32.208V8.875Q32.208 8.875 32.208 8.875Q32.208 8.875 32.208 8.875H7.792Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875ZM7.792 13.625V8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875V13.625Z"
                    />
                </svg>
            </div>
            <button type="button" trip-finder="button" class="js-search-button">
                Search
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        regions: Object,
        countries: Object,
        interests: Object,
        wildlives: Object,
    },
    setup() {},
    data() {
        return {
            search: {
                region: null,
                country: null,
                interest: null,
                wildlife: null,
            },
        };
    },
    methods: {
        selectCountry() {},
    },
};
</script>
