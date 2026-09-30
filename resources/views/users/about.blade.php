<x-about-layout>
    <div class="w-full bg-[#3c88f8]">
    <div class="absolute mx-5 md:mx-20 my-20 md:py-10 md:px-20 z-10">
        <p style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);" class="text-white font-bold text-3xl lg:text-4xl w-full xl:w-[900px] px-5 py-2">
        24f7 is your trusted partner for air conditioning solutions committed to delivering top quality products and reliable services.
        </p>
    </div>
    <img src="{{ asset('storage/24f7/about.png') }}" class="h-[400px] flex justify-self-end contrast-50 md:contrast-100 blur-sm md:blur-none w-full md:w-auto -z-10" alt="Logo">
    </div>

    <div class="my-20">
        <p class="text-xl font-medium mx-20 text-center">
        24F7 started as a freelance service founded by Gabriel Dungo, a skilled air conditioning
        technician with a passion for providing reliable and efficient cooling solutions. What began
        as a one-man operation has grown into a trusted name in the industry, known for our commitment
        to quality work, customer satisfaction, and 24/7 availability. <br> <br>
        With years of hands-on experience, we specialize in aircon installation, cleaning, repair, and maintenance
        services for both residential and commercial clients. At 24F7, we understand the value of comfort, especially
        in the tropical heat—that’s why we aim to deliver fast, friendly, and affordable service any time of the day.<br><br>
        We don’t just fix air conditioners—we build long-term relationships with our customers through trust, professionalism, and expertise.
        </p>
    </div>
    <div class="my-20">
        <h1 class="text-center text-4xl font-bold">24f7 Airconditioner Founder</h1>
        <img src="{{ asset('storage/24f7/about.png') }}" class="size-32 rounded-full object-cover border-2 border-black shadow-lg justify-self-center my-10" alt="Logo">
        <h1 class="text-center text-2xl font-medium">Gabriel Dungo</h1>
        <a href="https://www.linkedin.com/in/gabriel-dungo-5062a3343/" class="flex justify-center"><i class="fa-brands fa-linkedin text-2xl text-blue-600"></i></a>
    </div>
    <div>
        <h1 class="text-center text-4xl font-bold">Our Partners</h1>
        <div class="flex flex-col items-center space-y-10 md:space-y-0 md:flex-row place-content-center mt-5">
                <a href="#"><img src="{{ asset('storage/24f7/carrier.png') }}" alt="product"></a>
                <a href="#"><img src="{{ asset('storage/24f7/daikin.png') }}" alt="product"></a>
                <a href="#"><img src="{{ asset('storage/24f7/midea.png') }}" class="h-24" alt="product"></a>
            </div>
    </div>
</x-about-layout>
