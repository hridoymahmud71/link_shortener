<template>
    <div class=" bg-gray-200">
        <div class="container  mx-auto">
            <div class="h-screen flex flex-col justify-center items-center">
                    <!-- show before link is generated -->
                <div class="flex justify-center items-center" v-if="show_setion_before_link_generation">                 
                    <input type="text" class="h-16 w-96 px-6  z-0 focus:shadow focus:outline-none" placeholder="Paste your link here" v-model="given_link">                    
                    <button class="h-16 p-4 rounded-r-md text-white  bg-blue-500 hover:bg-blue-600" @click="get_generated_link" :disabled="generate_link_disable">Generate Link</button>                    
                </div>

                <!-- show after link is generated -->
                <div class="flex flex-wrap justify-center items-center" v-if="show_setion_after_link_generation">                 
                    <input type="text" class="h-16 w-96 px-4 text-gray-600 text-2xl  z-0 focus:shadow focus:outline-none" v-model="generated_link" readonly>                    
                    <button class="h-16 p-4 rounded-r-md text-white  bg-yellow-700 hover:bg-yellow-800" @click="handle_copy_click" >Copy Link</button>       
                    <label class="w-full text-center text-small text-gray-700 p-4" v-if="show_copied">Copied</label>             
                </div>
                <!-- response message -->
                <div class="mt-4" v-if="response_message_section.show">
                    <div class="text-green-600" v-if="response_message_section.success.show">{{ response_message_section.success.message }}</div>
                    <div class="text-red-500" v-if="response_message_section.error.show">{{ response_message_section.error.message }}</div>
                </div>

                <button class="mt-4 p-2 rounded text-white  bg-gray-600" @click="reset" v-if="show_reset" >Reset</button>     
            </div>
            
        </div>
    </div>
</template>

<script>

const axios = require('axios').default;


export default {

    data:()=> ({
        show_reset:false,
        generate_link_disable:false,
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
             this.show_reset = false;
             this.generate_link_disable = false
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
             this.generated_link = "";
             
        
        },

        show_success: function (message) {
            this.response_message_section.show = true;
            this.response_message_section.success.show = true;
            this.response_message_section.success.message = message;

            this.response_message_section.error.show = false;
            this.response_message_section.error.message = "";
        },

        show_error: function (message) {
            this.response_message_section.show = true;
            this.response_message_section.error.show = true;
            this.response_message_section.error.message = message;

            this.response_message_section.success.show = false;
            this.response_message_section.success.message = "";
        },

        handle_copy_click: function () {
            navigator.clipboard.writeText(this.generated_link);
            this.show_copied = true;

            setTimeout(() => {
                this.show_copied = false;
            }, 3000);
        },

        response_success: function(response){
            console.log(response);

            if(response.data.result) {
                this.show_success(response.data.message);
                this.set_success_data(response);
            } else {
                this.show_error(response.data.message);
                this.set_fail_data(response);
            }
        },

        set_success_data: function(response){
            this.generated_link = response.data.data.link;
            
            this.show_setion_before_link_generation = false;
            this.show_setion_after_link_generation = true;
        },

        set_fail_data: function(){
            this.generated_link = "";

            this.show_setion_before_link_generation = true;
            this.show_setion_after_link_generation = false;
        },
        response_error: function(error){
            this.response_message_section.show = true;
            this.response_message_section.error.show = true;
            this.response_message_section.error.message  = "Something went wrong !"

        },

         get_generated_link : function () {
            this.generate_link_disable = true;
            axios.post(`${window.base_url}/api/generate-link`, {
                given_link:this.given_link
            })
            .then( (response) =>{
                this.response_success(response);
            })
            .catch( (error) => {
                this.response_error(error);
            })
            .then( () => {
                // always executed
                this.generate_link_disable = false;
                this.show_reset = true;
            });  
        
        }
    },
    mounted() {
        // what to do
    }
}
</script>