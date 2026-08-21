<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Testimoni Pasien - Puskesmas</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background-color: #00644A;
            color: #FFFFFF;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <section class="w-full py-12 sm:py-16 lg:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Badge --}}
            <div class="flex items-center justify-center mb-6">
                <div class="flex items-center gap-2">
                    <svg style="width:20px;height:20px;color:#76D9B3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/>
                    </svg>
                    <span style="font-size:12px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#76D9B3">Testimoni Pasien</span>
                </div>
            </div>

            {{-- Heading --}}
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#FFFFFF] leading-tight mb-4">
                    Simak Kesaksian Mereka yang Mempercayai Care Link
                </h2>
                <p class="text-sm sm:text-base text-[#FFFFFF]/70 leading-relaxed">
                    Pengalaman pasien kami berbicara banyak hal. Simak bagaimana CareLink telah memberikan perawatan ahli yang penuh kepedulian serta membawa perubahan positif dalam hidup mereka.
                </p>
            </div>

            {{-- Testimonial Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Card 1 --}}
                <div class="bg-[#191C1D] rounded-2xl p-6 border border-[#3E4944]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden shrink-0">
                            <img src="https://i.pravatar.cc/150?img=47" alt="Samantha Elizabeth" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-[#FFFFFF] text-sm">Samantha Elizabeth</h4>
                            <p class="text-[#FFFFFF]/70 text-xs">Jakarta</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-[#FB923C] flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-[#FFFFFF]/90 text-sm leading-relaxed mb-4">
                        "Saya mendapatkan pengalaman yang sangat baik di CareLink saat mengalami situasi darurat baru-baru ini. Tidak hanya mereka merespons dengan cepat, tetapi saya benar-benar merasa diperhatikan dan ditenangkan selama seluruh proses tersebut."
                    </p>
                    <div class="flex gap-1">
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="bg-[#191C1D] rounded-2xl p-6 border border-[#3E4944]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden shrink-0">
                            <img src="https://i.pravatar.cc/150?img=45" alt="Olivia Marie" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-[#FFFFFF] text-sm">Olivia Marie</h4>
                            <p class="text-[#FFFFFF]/70 text-xs">Bandung</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-[#FB923C] flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-[#FFFFFF]/90 text-sm leading-relaxed mb-4">
                        "CareLink telah menjadi andalan saya untuk konsultasi kesehatan, dan saya selalu terkesan dengan profesionalisme dan kepedulian para dokternya. Mereka meluangkan waktu untuk mendengarkan dan memberikan penjelasan, sehingga setiap kunjungan terasa personal."
                    </p>
                    <div class="flex gap-1">
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="bg-[#191C1D] rounded-2xl p-6 border border-[#3E4944]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden shrink-0">
                            <img src="https://i.pravatar.cc/150?img=44" alt="Jessica Claire" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-[#FFFFFF] text-sm">Jessica Claire</h4>
                            <p class="text-[#FFFFFF]/70 text-xs">Cirebon</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-[#FB923C] flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-[#FFFFFF]/90 text-sm leading-relaxed mb-4">
                        "Para spesialis di CareLink memberikan panduan yang saya butuhkan untuk mengelola kondisi kesehatan saya. Keahlian mereka dalam spesialisasi saya sangat membantu proses pemulihan saya, dan saya bersyukur atas perawatan menyeluruh yang saya terima."
                    </p>
                    <div class="flex gap-1">
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 text-[#FB923C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
