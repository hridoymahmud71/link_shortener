<template>
    <div class=" bg-gray-200">
        <div class="container h-screen flex flex-col justify-center items-center">

            <!-- show before link is generated -->
            <div class="flex justify-center items-center">                 
                <input type="text" class="h-16 w-96 px-6  z-0 focus:shadow focus:outline-none" placeholder="Paste your link here">                    
                <button class="h-16 p-4 rounded-r-md text-white  bg-blue-500 hover:bg-blue-600">Generate Link</button>                    
            </div>

            <!-- show after link is generated -->
            <div class="flex justify-center items-center">                 
                <input type="text" class="h-16 w-96 px-4 text-gray-600 text-2xl  z-0 focus:shadow focus:outline-none" value="https://192.158.63.65/23jds4e" readonly>                    
                <button class="h-16 p-4 rounded-r-md text-white  bg-yellow-700 hover:bg-yellow-800">Copy Link</button>       
                <label class="text-small text-gray-700 p-4">Copied</label>             
            </div>
            <!-- response message -->
            <div class="mt-4">
                <div class="text-green-600">This is a success response</div>
                <div class="text-red-500">This is a Error Response</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Example component mounted.')
    }
}
</script>