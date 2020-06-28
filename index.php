<?php

    require_once './vendor/autoload.php';
    require './init.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="./node_modules/vue/dist/vue.min.js"></script>
    <script src="./node_modules/axios/dist/axios.min.js"></script>
    <style>
        .fly-enter-active,
        .fly-leave-active{
            transition: all .5s ease;
        }
        .fly-enter,
        .fly-leave-to{
            opacity: 0;
            transform: translateY(-2rem);
        }
        .fly-enter-to,
        .fly-leave{
            opacity: 1;
        }
        .fly-move{
            transition: all .25s ease-out;
        }
        .svg-md svg{
            height: 2rem!important;
            width: 2rem!important;
        }
    </style>
</head>
<body>
    <div id="root" class="bg-light">
        <div class="py-4">
            <transition-group class="row m-0" tag="div" name="fly" mode="out-in">
                <div class="d-flex justify-content-center col-12 px-0 position-sticky" style="top: 0px; z-index: 2" key="search">
                    <div class="col-lg-4 col-md-6 col-sm-10 px-0 bg-light">
                        <div class="alert">
                            <input type="text" class="form-control" placeholder="Temukan..." v-model="search">
                        </div>
                    </div>
                </div>
                <div class="mb-5 col-12">

                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1 svg-md" v-for="(icon, i) in icons" :key="icon.id">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="pr-3" v-html="icon.file">
                                </div>
                                <div>
                                    <div class="small text-muted">
                                        {{ icon.name }}
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 d-flex justify-content-end">
                                <button class="btn btn-light btn-sm px-3 py-2" type="button" @click.prevent="copy(i)">
                                    salin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition-group>
        </div>
    </div>
    <script>
        new Vue({
            el: '#root',
            data: {
                data: [],
                search: "",
            },
            computed: {
                icons: function(){
                    return this.data.filter(e => e.name.search(this.search) != -1 )
                },
            },
            methods: {
                ambilData(){
                    axios.get('http://localhost:3000/?get').then(e => {
                        for(let d in e.data){
                            this.data.push(e.data[d]);
                        }
                    });
                },
                copy(i){
                    let data = this.icons[i].file;
                    let text = document.createElement('textarea');
                    text.value = data;
                    document.body.appendChild(text);
                    text.select();
                    text.setSelectionRange(0, 99999);
                    document.execCommand('copy');
                    document.body.removeChild(text);
                }
            },
            created(){
                this.ambilData();
            }
        });
    </script>
</body>
</html>