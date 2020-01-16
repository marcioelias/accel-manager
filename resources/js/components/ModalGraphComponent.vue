<template>
    <div class="modal fade" ref="modalGraph" id="modalGraph" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <highcharts :options="chartOptions"></highcharts>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
import { VALID_MUTATIONS } from '../constants';

export default {
    data() {
        return {
            showModalGraph: false,
            timer: '',
            lastData: false,
            chartOptions: {
                chart: {
                    type: 'areaspline'
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.9
                    }
                },
                tooltip: {
                    valueSuffix: ' bps',
                    shared: true
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 100,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    title: {
                        text: 'bps',
                        unit: 'bps'
                    }
                },
                title: {
                    text: 'Tráfego na Interface',
                },
                series: [{
                    name: 'RX',
                    data: []
                }, {
                    name: 'TX',
                    data: []
                }]
            }
        }
    },
    computed: {
        graph: {
            get() {
                return this.$store.state.graph;
            },
            set(value) {
                this.$store.commit(VALID_MUTATIONS.SET_GRAPH, value);
            }
        } 
    },
    watch: {
        graph: function (value) {
            if (value.hasOwnProperty("username")) {
                $(this.$refs.modalGraph).modal('show');
            }
        }
    },
    created() {
        
    },
    mounted() {
         $(this.$refs.modalGraph).on("hidden.bs.modal", this.doOnCloseModal);
         $(this.$refs.modalGraph).on("show.bs.modal", this.doOnShowModal);
    },
    methods: {
        doOnCloseModal() {
            this.graph = false;
            clearInterval(this.timer);
        },
        doOnShowModal() {
            this.getInterfaceStats(this.graph.ifname);
            this.timer = setInterval(this.getInterfaceStats, 1000);
            this.chartOptions.series[0].data = [];
            this.chartOptions.series[1].data = [];
        },
        getInterfaceStats: function() {
            Axios.get('/interface/'+'enxc025e91b5e52'+'/json')
                .then(async r => {
                    if (!this.lastData) {
                        this.lastData = r.data;
                    } else {
                        let shift = this.chartOptions.series[0].data.length > 60;
                        let timeDiff = r.data.stamp - this.lastData.stamp;
                        let rxSpeed = (r.data.rxbytes - this.lastData.rxbytes) * 1000 * 8 / timeDiff;
                        let txSpeed = (r.data.txbytes - this.lastData.txbytes) * 1000 * 8 / timeDiff;
                        if (shift) {
                            this.chartOptions.series[0].data = this.chartOptions.series[0].data.slice(1).slice(-60);
                            this.chartOptions.series[1].data = this.chartOptions.series[1].data.slice(1).slice(-60);
                        }
                        this.chartOptions.series[0].data.push([r.data.stamp, rxSpeed]);
                        this.chartOptions.series[1].data.push([r.data.stamp, txSpeed]);
                        
                        this.lastData = r.data;
                    }
                })
                .catch(r => {
                    console.log(r);
                });
        }
    },
}
</script>