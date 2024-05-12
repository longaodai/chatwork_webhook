<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Long Kun ChatWork Webhook Integration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- Navigation -->
<nav id="header"
     class="bg-white fixed w-full z-10 top-0 shadow border-b border-gray-200 bg-gray-900 text-white">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="pl-4 flex items-center">
            <a class="text-white text-base no-underline hover:no-underline font-bold" href="#">
                Long Kun ChatWork Webhook
            </a>
        </div>
        <div class="block lg:hidden pr-4">
            <button id="nav-toggle"
                    class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-gray-900 p-4 lg:p-0 z-20"
             id="nav-content">
            <ul class="list-reset lg:flex justify-end flex-1 items-center">
                <li class="mr-3">
                    <a class="inline-block py-2 px-4 text-white font-bold no-underline"
                       href="#features">Features</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-white no-underline hover:text-gray-200 hover:underline py-2 px-4"
                       href="https://hioncoding.com/about">About</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-white no-underline hover:text-gray-200 hover:underline py-2 px-4"
                       href="https://hioncoding.com/contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="pt-24">
    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!-- Left Column -->
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
            <p class="uppercase tracking-loose w-full">Webhook ChatWork</p>
            <h1 class="my-4 text-5xl font-bold leading-tight">Integrate Long Kun ChatWork Webhook</h1>
            <p class="leading-normal text-2xl mb-8">Start receiving and responding to messages from ChatWork
                using webhooks.</p>
<!--            <a href="#features"-->
<!--               class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition duration-300 ease-in-out">Learn-->
<!--                More</a>-->
        </div>
        <!-- Right Column -->
        <div class="w-full md:w-3/5 py-6 text-center">
            <img class="w-full md:w-4/5 z-50"
                 src="/public/images/top-page.jpg"
                 alt="Webhook Image">
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="relative -mt-12 lg:-mt-24 bg-gray-100">
    <div class="container mx-auto lg:px-4">
        <div id="features" class="flex flex-wrap items-center">
            <div class="w-full md:w-1/2 lg:w-1/3 p-6">
                <h3 class="text-2xl font-bold leading-none mb-3">Receive Messages</h3>
                <p class="text-gray-700 mb-8">Set up a webhook endpoint to receive messages from ChatWork
                    users.</p>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-6">
                <h3 class="text-2xl font-bold leading-none mb-3">Process Data</h3>
                <p class="text-gray-700 mb-8">Process incoming messages to extract relevant information or
                    trigger actions.</p>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-6">
                <h3 class="text-2xl font-bold leading-none mb-3">Respond Automatically</h3>
                <p class="text-gray-700 mb-8">Develop logic to automatically respond to messages based on
                    predefined rules or criteria.</p>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div id="about" class="py-12 bg-gray-200">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h2 class="text-3xl font-semibold leading-tight mb-8">About Long Kun ChatWork Webhook</h2>
            <p class="text-lg leading-relaxed mb-8">Long Kun ChatWork Webhook allows you to integrate ChatWork with your
                applications, enabling seamless communication and workflow automation.</p>
            <a href="https://hioncoding.com/contact"
               class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition duration-300 ease-in-out">Contact
                Us</a>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div id="contact" class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h2 class="text-3xl font-semibold leading-tight mb-8">Contact Us</h2>
            <p class="text-lg leading-relaxed mb-8">Have questions or need assistance? Feel free to reach out to
                us.</p>
            <a href="https://hioncoding.com/" class="text-lg underline">https://hioncoding.com/</a>
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-4 text-center">
        <p class="mb-2">© <?= date('Y') ?> Long Kun ChatWork Webhook. All rights reserved.</p>
    </div>
</footer>

<script>
    // JavaScript code here
</script>

</body>

</html>
