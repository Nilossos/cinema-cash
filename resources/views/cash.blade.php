@extends('layout')
@section('content')
    <main class="mt-6">
        <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">
            <div
                id="docs-card"
                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
            >
                <div class="relative flex items-center gap-6 lg:items-end">
                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                        <div class="pt-3 sm:pt-5 lg:pt-0">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Бронирование мест</h2>
                            <div class="legend">
                                <div class="legend-item">
                                    <div class="legend-color red"></div>
                                    <div class="legend-text"> - Забронированные места;</div>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color blue"></div>
                                    <div class="legend-text"> - Выбранные места;</div>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color black"></div>
                                    <div class="legend-text"> - Свободные места;</div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 sm:pt-5 lg:pt-0">
                            <div class="container">
                                <table class="table">
                                    <tbody>
                                    @foreach ($rows as $row)
                                        <tr>
                                            <th>Ряд {{ $row->row_number }}</th>
                                            @foreach ($row->seats as $seat)
                                                <td class="seat {{ $seat->is_booked ? "booked" : "" }}"
                                                    data-seat-number="{{ $seat->id }}" data-is-booked="{{ $seat->is_booked }}">{{ $seat->seat_number }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button id="book-seats-btn">Выбрать места</button>
                                <button id="release-seats-btn">Освободить места</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
