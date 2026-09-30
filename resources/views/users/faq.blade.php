@extends('layouts.user.static')

@section('content')
<div class="faq-container max-w-3xl mx-auto my-8" x-data="{ activeTab: null }">

    {{-- CATEGORY: Order Process & Payment --}}
    <h2 class="text-xl font-bold mb-4 mt-8">Order Process & Payment</h2>
    @php
        $orderFaqs = [
            'How can I order?' => '
                <p class="text-gray-700 mb-4">Follow these simple steps:</p>
                <ol class="list-roman pl-6 space-y-2">
                    <li>Log into your account</li>
                    <li>Shop for product/s and click the Add to Cart button</li>
                    <li>When you\'ve finished shopping, select Check Out</li>
                    <li>Enter your details, select a payment option, and check out</li>
                    <li>You will receive an email confirmation of payment...</li>
                </ol>
            ',
            'What payment options are available?' => 'We accept Gcash, Maya, and Cash On Deliveries.',
            'Can I avail of cash financing / pahulugan online?' => 'No, as of no we do not offer any cash financing but we will update soon when this is available.',
        ];
    @endphp
    @foreach($orderFaqs as $question => $answer)
        @php $index = $loop->index + 1; @endphp
        @include('components.faq-item', ['index' => $index, 'question' => $question, 'answer' => $answer])
    @endforeach

    {{-- CATEGORY: Shipping & Delivery --}}
    <h2 class="text-xl font-bold mb-4 mt-12">Shipping & Delivery</h2>
    @php
        $shippingFaqs = [
            'Where do you deliver?' => 'We only deliver around cavite.',
            'How can I track my order?' => 'You can track it via the Order Status page.',
            'When will my order be delivered?' => 'Within 3-5 business days.',
            'Can someone else receive my order for me?' => 'Yes, just ensure they have a valid ID.',
        ];
    @endphp
    @foreach($shippingFaqs as $question => $answer)
        @php $index = $loop->index + 100; @endphp
        @include('components.faq-item', ['index' => $index, 'question' => $question, 'answer' => $answer])
    @endforeach

    {{-- CATEGORY: Return & Exchange --}}
    <h2 class="text-xl font-bold mb-4 mt-12">Return & Exchange</h2>
    @php
        $returnFaqs = [
            'Can I return or exchange the item I bought?' => 'Yes, within 7 days with receipt.',
        ];
    @endphp
    @foreach($returnFaqs as $question => $answer)
        @php $index = $loop->index + 200; @endphp
        @include('components.faq-item', ['index' => $index, 'question' => $question, 'answer' => $answer])
    @endforeach

</div>
@endsection
