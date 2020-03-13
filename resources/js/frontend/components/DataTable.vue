<template>
    <div class="card">
        <div class="card-header">{{ response.table }}</div>

        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-10">
                    <label for="filter">Quick search current results</label>
                    <input type="text" id="filter" class="form-control" v-model="quickSearchQuery">
                </div>
                <div class="form-group col-md-2">
                    <label for="limit">Display records</label>
                    <select id="limit" class="form-control" v-model="limit">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="">All</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th v-for="column in response.displayable" :key="column">
                                <span class="sortable" @click="sortBy(column)">{{ column }}</span>
                                <div
                                    class="arrow"
                                    v-if="sort.key === column"
                                    :class="{ 'arrow--asc': sort.order === 'asc', 'arrow--desc': sort.order === 'desc' }"
                                ></div>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="record in filteredRecords" :key="response.records.indexOf(record)">
                            <td v-for="columnValue, column in record" :key="column">{{ columnValue }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["endpoint"],

        data() {
            return {
                response: {
                    table: '',
                    displayable: [],
                    records: []
                },
                sort: {
                    key: 'id',
                    order: 'asc'
                },
                quickSearchQuery: '',
                limit: 50
            };
        },

        computed: {
            filteredRecords() {
                let data = this.response.records;

                data = data.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.quickSearchQuery.toLowerCase()) > -1
                    });
                });

                if (this.sort.key) {
                    data = _.orderBy(data, (i) => {
                        let value = i[this.sort.key];

                        if (!isNaN(parseFloat(value))) {
                            return parseFloat(value);
                        }

                        return String(i[this.sort.key]).toLowerCase();
                    }, this.sort.order);
                }

                return data;
            }
        },

        methods: {
            getRecords() {
                return axios.get(`${this.endpoint}`)
                    .then(response => {
                        this.response = response.data.data;
                    })
            },

            sortBy(column) {
                this.sort.key = column;
                this.sort.order = this.sort.order === 'asc' ? 'desc' : 'asc';
            }
        },

        mounted() {
            this.getRecords();
        }
    }
</script>

<style lang="scss" scoped>

    .sortable {
        cursor: pointer;
    }

    .arrow {
        display: inline-block;
        vertical-align: middle;
        width: 0;
        height: 0;
        margin-left: 5px;
        opacity: .6;

        &--asc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid #222;
        }

        &--desc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #222;
        }
    }
</style>