<x-app-layout>
    <div class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="flow-root">
            <a href="{{ route('invoices.create') }}">
                <x-primary-button class="mt-3 float-right">
                    {{ __('Add Invoice') }}
                </x-primary-button>
            </a>
        </div>

        <div class="mt-5 bg-white shadow-sm rounded-lg divide-y">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">SL</th>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Invoice No</th>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Uploaded At</th>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Purchased At</th>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Ship To</th>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Payee</th>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 bg-red-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $invoice->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $invoice->invoice_no }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $invoice->created_at->format('j M Y, g:i a') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $invoice->invoice_date->format('j M Y, g:i a')}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $invoice->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $invoice->merchant_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $invoice->total }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">
                                <form method="POST" action="{{ route('invoices.update', $invoice->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="bg-gray-100 py-2 px-2 rounded border-transparent" onchange="this.form.submit()">
                                        <option value="Completed" {{ $invoice->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Pending" {{ $invoice->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </form>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <a href="{{ route('invoices.show', ['invoice' => $invoice->id]) }}">
                                <button class="bg-gray-100 py-2 px-2 rounded">{{ __('Details') }}
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>