<template>
    <v-card outlined color="#F8E2C0">
        <v-card-text>
            <v-row no-gutters>
                <v-col cols="12" sm="12" lg="6">
                    <div class="d-flex justify-start align-start">
                        <div class="textHereSmall Montserrat-Bold mr-1"> Expediente: </div>
                        <div class="textHereSmall Montserrat-Bold"> N° 2785-8596-2331853215</div>
                    </div>
                </v-col>
                <v-col cols="12" sm="12" lg="6">
                    <div class="d-flex align-start">
                        <div class="textHereSmall Montserrat-Bold mr-1"> Fecha: </div>
                        <div class="textHereSmall Montserrat-SemiBold"> 24/10/2021 </div>
                    </div>
                </v-col>
            </v-row>
            <v-row no-gutters align="center" class="mt-5">
                <div class="d-flex column justify-start">
                    <div class="textHereSmall Montserrat-Bold mb-2 mr-1"> Iniciador: </div>
                    <div class="textHereSmall Montserrat-SemiBold">{{ responsable }}</div>
                </div>
                <div class="d-flex column justify-start">
                    <div class="textHereSmall Montserrat-Bold mb-2 mr-1"> Extracto: </div>
                    <div class="textHereSmall Montserrat-SemiBold text-justify"> {{extracto}} </div>
                </div>
            </v-row>
        </v-card-text>
    </v-card>
</template>
<script>
    export default {
        name: 'Card Extracto Pase',
        props: {
            expediente:String,
            fecha:String,
            responsable:String,
            extracto:String,
        },
    }
</script>
<style>
    .textHere{
        font-size: 25px;
    }
    .textHereSmall{
        font-size: 16px;
    }
    @media (max-width: 768px) {
        .textHere {
            font-size: 11px;
        }
        .textHereSmall {
            font-size: 11px;
        }
    }
</style>