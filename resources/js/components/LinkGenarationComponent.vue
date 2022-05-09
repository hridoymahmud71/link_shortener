<template>
    <div class=" bg-gray-200">
        <div class="container h-screen flex flex-col justify-center items-center">

            <!-- show before link is generated -->
            <div class="flex justify-center items-center" v-if="show_setion_before_link_generation">                 
                <input type="text" class="h-16 w-96 px-6  z-0 focus:shadow focus:outline-none" placeholder="Paste your link here" v-model="given_link">                    
                <button class="h-16 p-4 rounded-r-md text-white  bg-blue-500 hover:bg-blue-600">Generate Link</button>                    
            </div>

            <!-- show after link is generated -->
            <div class="flex justify-center items-center" v-if="show_setion_after_link_generation">                 
                <input type="text" class="h-16 w-96 px-4 text-gray-600 text-2xl  z-0 focus:shadow focus:outline-none" v-model="generated_link" readonly>                    
                <button class="h-16 p-4 rounded-r-md text-white  bg-yellow-700 hover:bg-yellow-800" @click="handle_copy_click">Copy Link</button>       
                <label class="text-small text-gray-700 p-4" v-if="show_copied">Copied</label>             
            </div>
            <!-- response message -->
            <div class="mt-4" v-if="response_message_section.show">
                <div class="text-green-600" v-if="response_message_section.success.show">{{ response_message_section.success.message }}</div>
                <div class="text-red-500" v-if="response_message_section.error.show">{{ response_message_section.error.message }}</div>
            </div>
        </div>
    </div>
</template>

<script>

const axios = require('axios').default;


export default {

    data:()=> ({
        show_setion_before_link_generation: true,
        show_setion_after_link_generation: false,
        show_copied: false,
        response_message_section: {
            show:false,
            success:{
                show:false,
                message:""
            },
            error:{
                show:false,
                message:""
            }
        },
        given_link:"",
        generated_link:""
    }),

    methods: {
        reset: function () {
             this.show_setion_before_link_generation = true;
             this.show_setion_after_link_generation = false;
             this.show_copied = false;
             this.response_message_section = {
                show:false,
                success:{
                    show:false,
                    message:""
                },
                error:{
                    show:false,
                    message:""
                }
            };
             this.given_link = "";
             this.given_link = "";
             
        
        },

        show_success: function (message) {
        
        },

        show_error: function (message) {
        
        },

        handle_copy_click: function () {
        
        },

        get_generated_link: function () {

            axios.post(`${window.base_url}/api/generate-link`, {
                given_link:this.given_link
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });  
        
        }
    },
    mounted() {
        // what to do
    }
}
</script>