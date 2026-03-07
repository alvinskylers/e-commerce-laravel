<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4">Product Details</th>
                                <th class="px-6 py-4">Customer</th>
                                <th class="px-6 py-4">Contact & Address</th>
                                <th class="px-6 py-4">Price</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4  ">
                                            <div class="w-16 h-auto"> <img src="{{ asset('products/' . $order->product->product_image) }}"
                                                                           alt="Product Image"
                                                                           class="aspect-[3/4] w-full object-cover rounded-md border border-gray-100 shadow-sm">
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $order->product->product_title }}</div>
                                                <div class="text-xs text-indigo-600 font-medium">{{ $order->product->product_category }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 line-clamp-1" title="{{ $order->reciever_address }}">
                                            {{ $order->reciever_address }}
                                        </div>
                                        <div class="text-xs text-gray-400 italic">{{ $order->reciever_phone }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            ${{ number_format($order->product->product_price, 2) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 font-medium">View</a>
                                            <button class="text-red-600 hover:text-red-900 font-medium">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
