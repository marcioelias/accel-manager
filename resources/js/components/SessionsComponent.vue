<template>
    <div class="card border-0">
        <div class="card-header m-0 p-0 border-0">
            <form v-on:submit.prevent>
                <div class="row m-0 p-0">
                    <div class="col-3 m-0 p-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-info" @click="doOnSync()" data-toggle="tooltip" data-placement="top" title="Atualizar dados">
                                    <i class="fas fa-sync-alt" :class="isLoading"></i>
                                </button>
                                <span class="input-group-text">Registros por página</span>
                            </div>
                            <select name="items-per-page" class="form-control" v-model="itemsPerPage">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="999999999">Todos</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3 m-0 p-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Buscar por</span>
                            </div>
                            <select name="filter" class="form-control" v-model="filterBy">
                                <option value="ifname">Interface</option>
                                <option value="username" selected>User</option>
                                <option value="ip">Endereço IPv4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 m-0 p-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Digite aqui para buscar" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="filterValue">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body m-0 p-0">
            <table class="table table-sm table-condensed table-hover table-striped table-bordered mb-0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="table-bordered" v-for="column in visibleColumns" :key="column.id">
                            <div class="float-left">{{ column.label }}</div>
                            <button 
                                class="btn btn-outline-secondary btn-sm float-right"
                                :class="sortStyleBtn(column)" 
                                @click="doOnSortClick(column)" 
                                style="padding: 0.04rem 0.4rem">
                                    <i class="fas fa-sm" :class="sortStyleIcon(column)"></i>
                            </button>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <paginate name="items" :list="items" :per="parseInt(itemsPerPage)" :key="items" tag="tbody">
                    <tr  v-for="(item, index) in paginated('items')" :key="index">
                        <td v-for="column in visibleColumns" :key="column.id" :class="{ 'text-right': (column.type == 'number')}">{{ item[column.column] }}</td>
                        <td class="text-center">
                            <button v-if="userHasPermission('acessar-view-graph')" class="btn btn-sm btn-info" @click="doOnGraphClick(item)" data-toggle="tooltip" data-placement="top" title="Gráfico de consumo de banda"><i class="fas fa-chart-area"></i></button>
                            <button v-if="userHasPermission('acessar-change-rate-limit')" class="btn btn-sm btn-secondary" @click="doOnQueueClick(item)" data-toggle="tooltip" data-placement="top" title="Alteração de Queue"><i class="fas fa-tachometer-alt"></i></button>
                            <button v-if="userHasPermission('acessar-drop-pppoe')" class="btn btn-sm btn-danger" @click="doOnDropClick(item)" data-toggle="tooltip" data-placement="top" title="Derrubar conexão"><i class="fas fa-power-off"></i></button>
                        </td>
                    </tr>
                </paginate>
            </table>
        </div>
        <div class="card-footer m-0 p-0 border-0 bg-light">
            <nav>
                <paginate-links 
                    for="items" 
                    :limit="5" 
                    :show-step-links="true" 
                    :hide-single-page="true"
                    :classes="{
                        'ul': ['pagination', 'justify-content-center'],
                        'li': 'page-item',
                        'li a': 'page-link',
                    }">
                </paginate-links>
            </nav>
        </div>
        <div class="modal fade" ref="modalDropSession" id="modalDropSession" tabindex="-1" role="dialog" aria-labelledby="modalDropSession" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-power-off"></i> Atenção</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Derrubar a sessão PPPoE do usuário: <strong>{{ dropSession.username }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="doOnDropSession()">Sim</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" ref="modalChangeQueue" id="modalChangeQueue" tabindex="-1" role="dialog" aria-labelledby="modalChangeQueue" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-tachometer-alt"></i> Alteração de Queue</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="downloadSpeed">Download (Mbps)</label>
                                <input type="number" class="form-control" name="downloadSpeed" id="downloadSpeed" v-model="queue.tx">
                            </div>
                            <div class="form-group">
                                <label for="uploadSpeed">Upload (Mbps)</label>
                                <input type="number" class="form-control" name="uploadSpeed" id="uploadSpeed" v-model="queue.rx">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" @click="doOnChangeQueue()">Aplicar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" @click="doOnResetQueue()">Restaurar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <modal-graph-component></modal-graph-component>
    </div>
</template>

<script>
import { VALID_MUTATIONS } from '../constants';
import ModalGraphComponent from './ModalGraphComponent';

export default {
    data() {
        return {
            paginate: ['items'],
            paginationCurrentPage: 0,
            itemsPerPage: 10,
            dropSession: false,
            queue: {
                ifname: '',
                rx: '',
                tx: ''
            },
            timer: ''
        }
    },
    components: {
        ModalGraphComponent
    },
    computed: {
        items() {
            return this.$store.getters.sortedSessions;
        },
        visibleColumns() {
            return this.$store.getters.getVisibleColumns;
        },
        sortBy: {
            get() {
                return this.$store.state.sortBy;
            },
            set(value) {
                this.$store.commit(VALID_MUTATIONS.SET_SESSIONS_SORT_BY , value);
            }
        },
        sortAsc: {
            get() {
                return this.$store.state.sortAsc;
            },
            set(value) {
                this.$store.commit(VALID_MUTATIONS.SET_SESSIONS_SORT_ASC, value);
            }
        },
        filterBy: {
            get() {
                return this.$store.state.filterBy;
            },
            set(value) {
                this.$store.commit(VALID_MUTATIONS.SET_SESSIONS_FILTER_BY, value);
            }
        },
        filterValue: {
            get() {
                return this.$store.state.filterValue;
            },
            set(value) {
                if (value != this.$store.state.filterValue) {
                    this.$store.commit(VALID_MUTATIONS.SET_SESSIONS_FILTER_VALUE, value);
                }
            }
        },
        isLoading() {
            return {
                'fa-spin': this.$store.state.loading
            }
        },
    },
    mounted() {
        $(this.$refs.modalChangeQueue).on("hidden.bs.modal", this.doOnCloseModalChangeQueue);
    },
    created() {
        this.timer = setInterval(this.getSessions, 10000);
    },
    beforeDestroy() {
        this.cancelAutoUpdate();
    },
    methods: {
        getUserPermissions() {
            this.$store.dispatch('apiUserPermissions');
        },
        getSessions() {
            this.$store.dispatch('apiGetSessions');
        },
        cancelAutoUpdate() {
            clearInterval(this.timer);
        },
        doOnSortClick(column) {
            if (this.sortBy == column.column) {
                this.sortAsc = !this.sortAsc;
                this.sortType = column.type
            } else {
                this.sortBy = column.column;
                this.sortAsc = true;
                this.sortType = column.type
            }
        },
        sortStyleBtn: function(column) {
            return {
                'btn-secondary': column.column == this.sortBy,
                'text-white': column.column == this.sortBy,
                'btn-outline-secondary': column.column != this.sortBy,
            }
        },
        sortStyleIcon: function(column) {
            return {
                'fa-sort': column.column != this.sortBy,
                'fa-sort-down': ((column.column == this.sortBy) && (this.sortAsc)),
                'fa-sort-up': ((column.column == this.sortBy) && (!this.sortAsc)),
            }
        },
        doOnGraphClick: function(item) {
            this.$store.commit(VALID_MUTATIONS.SET_GRAPH, item);
        },
        doOnDropClick: function(item) {
            this.dropSession = item;
            $(this.$refs.modalDropSession).modal('show');
        },
        doOnDropSession: function() {
            this.$store.dispatch('apiDropSession', this.dropSession);
            this.dropSession = false;
        },
        doOnQueueClick: function(item) {
            this.queue.ifname = item.ifname;
            $(this.$refs.modalChangeQueue).modal('show');
        },
        doOnChangeQueue: function() {
            this.$store.dispatch('apiChangeQueue', this.queue);
        },
        doOnCloseModalChangeQueue: function() {
            this.queue = { ifname: '', rx: '', tx: '' };
        },
        doOnResetQueue: function() {
            this.$store.dispatch('apiResetQueue', this.queue);
        },
        doOnSync: function() {
            this.$store.dispatch('apiGetSessions');
        },
        userHasPermission(permission) {
            return this.$store.getters.userHasPermission(permission);
        }
    },
}
</script>