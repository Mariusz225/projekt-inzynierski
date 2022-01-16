import mutations from './mutations.js';
import actions from './actions.js';
import getters from './getters.js';

export default {
    namespaced: true,
    state() {
        return {
            lastFetch: null,
            shopDatesAvailabilities: [],
            shops: {
                // "type": "FeatureCollection",
                "features": [{
                    // "type": "Feature",
                    "geometry": {
                        // "type": "Point",
                        "coordinates": [
                            4.892951,
                            52.373564
                        ]
                    },
                    "properties": {
                        "address": "Valkensteeg 3, 1012 MH",
                        "city": "Amsterdam"
                    }
                },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.891881,
                                52.369741
                            ]
                        },
                        "properties": {
                            "address": "Rokin 92I 1012 KZ",
                            "city": "Amsterdam"
                        }
                    },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.901278,
                                52.369070
                            ]
                        },
                        "properties": {
                            "address": "Waterlooplein 29A, 1011 NX",
                            "city": "Amsterdam"
                        }
                    },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.894093,
                                52.371760
                            ]
                        },
                        "properties": {
                            "address": "Pieter Jacobszstraat 10D, 1012 HL",
                            "city": "Amsterdam"
                        }
                    },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.900800,
                                52.372008
                            ]
                        },
                        "properties": {
                            "address": "Nieuwmarkt 107, 1011 MA",
                            "city": "Amsterdam"
                        }
                    },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.4787379,
                                51.9202978
                            ]
                        },
                        "properties": {
                            "address": "Coolsingel 105, 3012 AG",
                            "city": "Rotterdam"
                        }
                    },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.476373,
                                51.915708
                            ]
                        },
                        "properties": {
                            "address": "Witte de Withstraat 63 3012 BN",
                            "city": "Rotterdam"
                        }
                    },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.468606,
                                51.922971
                            ]
                        },
                        "properties": {
                            "address": "Weena 691, 3013 AM ",
                            "city": "Rotterdam"
                        }
                    },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.483948,
                                51.925560
                            ]
                        },
                        "properties": {
                            "address": "Goudsesingel 411, 3032 EN",
                            "city": "Rotterdam"
                        }
                    },
                    {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                4.472817,
                                51.929622
                            ]
                        },
                        "properties": {
                            "address": "Paap Dirckstraat 68, 3032 SW",
                            "city": "Rotterdam"
                        }
                    }
                ]
            },
            // shops: {}
        };
    },
    mutations,
    actions,
    getters
}