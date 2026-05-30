@extends('layouts.app')

@section('content')
<main class="z-0 text-zinc-50 font-light">
    
    <div class="bg-black text-white relative -mb-34">
    <div class="relative isolate pt-14 flex flex-col justify-center items-center overflow-hidden">
                    <img class="absolute inset-0 -z-10 size-full object-cover blur-md opacity-70"  srcset="https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_320_212.jpg 320w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_375_248.jpg 375w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_414_274.jpg 414w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_512_339.jpg 512w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_640_424.jpg 640w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_750_497.jpg 750w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_828_548.jpg 828w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1024_678.jpg 1024w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1280_848.jpg 1280w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1440_953.jpg 1440w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1536_1017.jpg 1536w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1920_1271.jpg 1920w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_2048_1356.jpg 2048w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjA0OCAxMzU2Ij4KCTxpbWFnZSB3aWR0aD0iMjA0OCIgaGVpZ2h0PSIxMzU2IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEE2MnhsdEpJOTZTcVI5YWx1OVN0b29XMnVDd0hyWG1HaHZlUXcrV3pNSzJoREpMeVdQNTFkVEZhR2xLalozSmJqeEROSk1VQ0U4MUl2blhLWmtHQlZPU0ZvMkRJb0pGVk5RMWg3YU1LY3FheHBZaVYvZWVodlZqRkwzVWMvRHJOeWVSZ1ZaWFc3cFZPQ0tLSytzbmg2U2g4S1BFOXJQbnRjZmI2MWRHVVpJTmJjVnZGcU9HblVFMFVWenp3OUowN3VLTzFUbGZjLy85az0iPgoJPC9pbWFnZT4KPC9zdmc+ 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/IMG_3.jpg" width="320" height="212" alt="IMG_3">

                <div
            class="absolute top-0 left-0 pointer-events-none w-full h-26 -z-10 bg-gradient-to-b from-black from-0% via-black/15 via-70% to-black/0 to-95% bg-blend-overlay"></div>
        <div
            class="absolute inset-0 -z-10 bg-gradient-to-b from-black/10 from-0% via-black/20 via-80% to-black to-95% bg-blend-overlay"></div>

        <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6">
    <div class="relative grid grid-cols-4 lg:grid-rows-2 gap-4 h-[40svh] min-h-96">
                                    <button
    type="button" class="bg-zinc-900 rounded-2xl shadow-lg relative overflow-hidden group cursor-pointer col-span-4 lg:col-span-2 lg:row-span-2 h-full" @click="$dispatch('open-gallery-modal', { tab: 'gallery', mediaId: 14731 })">
            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"  srcset="https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_320_212.jpg 320w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_375_248.jpg 375w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_414_274.jpg 414w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_512_339.jpg 512w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_640_424.jpg 640w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_750_497.jpg 750w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_828_548.jpg 828w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1024_678.jpg 1024w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1280_848.jpg 1280w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1440_953.jpg 1440w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1536_1017.jpg 1536w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_1920_1271.jpg 1920w, https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_2048_1356.jpg 2048w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjA0OCAxMzU2Ij4KCTxpbWFnZSB3aWR0aD0iMjA0OCIgaGVpZ2h0PSIxMzU2IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEE2MnhsdEpJOTZTcVI5YWx1OVN0b29XMnVDd0hyWG1HaHZlUXcrV3pNSzJoREpMeVdQNTFkVEZhR2xLalozSmJqeEROSk1VQ0U4MUl2blhLWmtHQlZPU0ZvMkRJb0pGVk5RMWg3YU1LY3FheHBZaVYvZWVodlZqRkwzVWMvRHJOeWVSZ1ZaWFc3cFZPQ0tLSytzbmg2U2g4S1BFOXJQbnRjZmI2MWRHVVpJTmJjVnZGcU9HblVFMFVWenp3OUowN3VLTzFUbGZjLy85az0iPgoJPC9pbWFnZT4KPC9zdmc+ 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/IMG_3.jpg" width="320" height="212" alt="IMG_3">

    </button>
                

                                    <button
    type="button" class="bg-zinc-900 rounded-2xl shadow-lg relative overflow-hidden group cursor-pointer max-md:hidden" @click="$dispatch('open-gallery-modal', { tab: 'gallery', mediaId: 14730 })">
            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"  srcset="https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_320_212.jpg 320w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_375_248.jpg 375w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_414_274.jpg 414w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_512_339.jpg 512w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_640_424.jpg 640w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_750_497.jpg 750w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_828_548.jpg 828w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_1024_678.jpg 1024w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_1280_848.jpg 1280w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_1440_953.jpg 1440w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_1536_1017.jpg 1536w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_1920_1271.jpg 1920w, https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_2048_1356.jpg 2048w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjA0OCAxMzU2Ij4KCTxpbWFnZSB3aWR0aD0iMjA0OCIgaGVpZ2h0PSIxMzU2IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEFxSHhMR3lmYzVvdDljRWpmS3RZRnJieTNxL0tBSzJvZE5TenRkN2tGajJya3B1cEhRNnVmbTNOeTMxMk5DTXB6V2gvd21rRnJ3eVZ6bHQ1VWtMTVV4dHJCdWJ0R3V5V1g1UjBxNVY1eDBaTTZjSks1eWVuNjVlVy8zR3FTNzhUYWcwZ0cvajBvb3JxYU9lTW5ZbGc4VDM0WGJrWU5YSXRUa3VFK2RGb29yQ1NSdEYzUC85az0iPgoJPC9pbWFnZT4KPC9zdmc+ 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/IMG_2.jpg" width="320" height="212" alt="IMG_2">

    </button>
                                    <button
    type="button" class="bg-zinc-900 rounded-2xl shadow-lg relative overflow-hidden group cursor-pointer max-md:hidden" @click="$dispatch('open-gallery-modal', { tab: 'gallery', mediaId: 14811 })">
            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"  srcset="https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_320_213.jpg 320w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_375_250.jpg 375w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_414_276.jpg 414w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_512_341.jpg 512w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_640_427.jpg 640w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_750_500.jpg 750w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_828_552.jpg 828w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_1280_853.jpg 1280w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_1440_960.jpg 1440w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_1536_1024.jpg 1536w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_1920_1280.jpg 1920w, https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_2048_1365.jpg 2048w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjA0OCAxMzY1Ij4KCTxpbWFnZSB3aWR0aD0iMjA0OCIgaGVpZ2h0PSIxMzY1IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEF5NU5OVGZtclduNlVzODZxdzcxWVN5dTIrK01FVmRpbnVMWmNyRUJ0NzF6WVNVVk5ObzY2OHBTaFpGaTYwY0xHRnh3QldCZDZjWXp4VW1wK0lyL2RqWmdWbFRhckpLNmd1Yzk2K29wNDZVVjhMUG1hMldlMGQ3blplSUxwNEpTSXdCV0JKZXpORUNXb29yeU10aXJMUTkvRk5uUDZqZnpFa1pxbHBraG0xQlZmcFJSWDF6aWxoMjB1aDRjVzNWVnovOWs9Ij4KCTwvaW1hZ2U+Cjwvc3ZnPg== 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/IMG_78.jpg" width="320" height="213" alt="IMG_78">

    </button>
                                    <button
    type="button" class="bg-zinc-900 rounded-2xl shadow-lg relative overflow-hidden group cursor-pointer max-md:hidden" @click="$dispatch('open-gallery-modal', { tab: 'gallery', mediaId: 14746 })">
            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"  srcset="https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_320_213.jpg 320w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_375_250.jpg 375w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_414_276.jpg 414w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_512_341.jpg 512w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_640_427.jpg 640w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_750_500.jpg 750w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_828_552.jpg 828w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_1280_853.jpg 1280w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_1440_960.jpg 1440w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_1536_1024.jpg 1536w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_1920_1280.jpg 1920w, https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_2048_1365.jpg 2048w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjA0OCAxMzY1Ij4KCTxpbWFnZSB3aWR0aD0iMjA0OCIgaGVpZ2h0PSIxMzY1IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEEzV1hjOWFkcVZXTUNSZ0s1VmZFRnMwd0VaM2M5cTBiK1F6V2l5aGluRmNsTzhkVHJxNm82V09TSW41WEJwRnYwM2xCeml1SmsxTjlNdFBPVmkvclVPa2VJM3VibG1LL2VyZHlkam5qRzVhMExRYk9PWE8wbkhyV3pyZHJHdGcyM2pBb29xS2VyVnphdTdSZGpudEd0WTczZkROOHlWcldtZzJkdE51akJvb3JXcXJTME9iRHR1R3AvLzlrPSI+Cgk8L2ltYWdlPgo8L3N2Zz4= 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/IMG_13.jpg" width="320" height="213" alt="IMG_13">

    </button>
                                    <button
    type="button" class="bg-zinc-900 rounded-2xl shadow-lg relative overflow-hidden group cursor-pointer max-md:hidden" @click="$dispatch('open-gallery-modal', { tab: 'gallery', mediaId: 14740 })">
            <img class="pointer-events-none size-full object-cover rounded-lg transition-all duration-300 group-hover:scale-110"  srcset="https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_320_213.jpg 320w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_375_250.jpg 375w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_414_276.jpg 414w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_512_341.jpg 512w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_640_427.jpg 640w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_750_500.jpg 750w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_828_552.jpg 828w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_1024_683.jpg 1024w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_1280_853.jpg 1280w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_1440_960.jpg 1440w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_1536_1024.jpg 1536w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_1920_1280.jpg 1920w, https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_2048_1365.jpg 2048w, data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHg9IjAiCiB5PSIwIiB2aWV3Qm94PSIwIDAgMjA0OCAxMzY1Ij4KCTxpbWFnZSB3aWR0aD0iMjA0OCIgaGVpZ2h0PSIxMzY1IiB4bGluazpocmVmPSJkYXRhOmltYWdlL2pwZWc7YmFzZTY0LC85ai80QUFRU2taSlJnQUJBUUVBWUFCZ0FBRC8vZ0ErUTFKRlFWUlBVam9nWjJRdGFuQmxaeUIyTVM0d0lDaDFjMmx1WnlCSlNrY2dTbEJGUnlCMk9EQXBMQ0JrWldaaGRXeDBJSEYxWVd4cGRIa0svOXNBUXdBSUJnWUhCZ1VJQndjSENRa0lDZ3dVRFF3TEN3d1pFaE1QRkIwYUh4NGRHaHdjSUNRdUp5QWlMQ01jSENnM0tTd3dNVFEwTkI4bk9UMDRNand1TXpReS85c0FRd0VKQ1FrTUN3d1lEUTBZTWlFY0lUSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5LzhBQUVRZ0FGUUFnQXdFaUFBSVJBUU1SQWYvRUFCOEFBQUVGQVFFQkFRRUJBQUFBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUUFBSUJBd01DQkFNRkJRUUVBQUFCZlFFQ0F3QUVFUVVTSVRGQkJoTlJZUWNpY1JReWdaR2hDQ05Dc2NFVlV0SHdKRE5pY29JSkNoWVhHQmthSlNZbktDa3FORFUyTnpnNU9rTkVSVVpIU0VsS1UxUlZWbGRZV1ZwalpHVm1aMmhwYW5OMGRYWjNlSGw2ZzRTRmhvZUlpWXFTazVTVmxwZVltWnFpbzZTbHBxZW9xYXF5czdTMXRyZTR1YnJDdzhURnhzZkl5Y3JTMDlUVjF0ZlkyZHJoNHVQazVlYm42T25xOGZMejlQWDI5L2o1K3YvRUFCOEJBQU1CQVFFQkFRRUJBUUVBQUFBQUFBQUJBZ01FQlFZSENBa0tDLy9FQUxVUkFBSUJBZ1FFQXdRSEJRUUVBQUVDZHdBQkFnTVJCQVVoTVFZU1FWRUhZWEVUSWpLQkNCUkNrYUd4d1Frak0xTHdGV0p5MFFvV0pEVGhKZkVYR0JrYUppY29LU28xTmpjNE9UcERSRVZHUjBoSlNsTlVWVlpYV0ZsYVkyUmxabWRvYVdwemRIVjJkM2g1ZW9LRGhJV0doNGlKaXBLVGxKV1dsNWlabXFLanBLV21wNmlwcXJLenRMVzJ0N2k1dXNMRHhNWEd4OGpKeXRMVDFOWFcxOWpaMnVMajVPWG01K2pwNnZMejlQWDI5L2o1K3YvYUFBd0RBUUFDRVFNUkFEOEF0blZnMERzVUlJSEZZQzZ2Tzl3ZDZIWm1wNE5WV2VGbWVMQU5KYVBEY3pFRlFGRmMzOXFZdlMxaXZxZEozdVhSRWx4RUpBZXRZR3RQOW5VS3BxNXFPb2pUdmxqRzRlMWNwcTkvTmRrRUtSWHJQTkp6cFdhc3pqK29SaFBtdWRKSzIxU3FqQXF0REl3a0NnNHlhS0srTnBTYlo2VjJkTmE2VmIzTVFNcTdqanZWZTgwYXpWc0NNZmxSUlh1eCtHdzdILy9aIj4KCTwvaW1hZ2U+Cjwvc3ZnPg== 32w" onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" sizes="1px" src="https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/IMG_8.jpg" width="320" height="213" alt="IMG_8">

    </button>
                                <div class="absolute bottom-4 right-4">
                    <button type="button"
    class="rounded-md bg-zinc-50 px-2.5 py-1.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 border border-zinc-400/50 shadow-lg" @click="$dispatch('open-gallery-modal', { tab: 'gallery' })">
    View all images
</button>
                </div>
            </div>
</div>
        <div class="h-26"></div>
    </div>

    
    <div x-intersect="$wire.__lazyLoad(&#039;eyJkYXRhIjp7ImZvck1vdW50IjpbeyJwcm9wZXJ0eSI6W251bGwseyJjbGFzcyI6IkFwcFxcTW9kZWxzXFxQcm9wZXJ0aWVzXFxQcm9wZXJ0eSIsImtleSI6MjcxLCJzIjoibWRsIn1dfSx7InMiOiJhcnIifV19LCJtZW1vIjp7ImlkIjoiaHdENzBSaWVjUm02SlRTRGN3bnMiLCJuYW1lIjoiX19tb3VudFBhcmFtc0NvbnRhaW5lciIsInBhdGgiOiJwcm9wZXJ0aWVzXC92aWxsYS1iYXJjZWxvbmEiLCJtZXRob2QiOiJHRVQiLCJyZWxlYXNlIjoiYS1hLWEifSwiY2hlY2tzdW0iOiIzNmMwYTIxOWRmMDc4OWJlMGE3NDRjZDFlZjk4YTg4MWNhZWQ5YmUyZTNjN2Y3MGZlMDgyM2FiYWY0ODkzMjZhIn0=&#039;)"></div></div>


    <div class="w-full max-w-7xl mx-auto p-6 lg:py-8 lg:px-8 z-0 space-y-6 relative !pb-0">
    <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div>
    <a href="#"></a>
    <h1 class="uppercase font-semibold mt-2">Aspen Mountain Chalet</h1>
</div>
<div class="flex flex-wrap gap-1.5 mb-3 text-zinc-50">
    <div><i class="fa-sharp fa-light fa-bed fa-sm me-1"></i> 6
        Bedrooms
    </div>
    ·
    <div><i class="fa-sharp fa-light fa-person fa-sm me-1"></i> 12
        Sleeps
    </div>
    ·
    <div><i class="fa-sharp fa-light fa-sink fa-sm me-1"></i>8
        Bathrooms
    </div>
</div>
<div class="text-zinc-50 relative" x-data="{ expanded: false }">
    <div x-show="expanded" x-collapse.min.120px>
        <div class="pb-9">
            <p>Experience unparalleled luxury in this custom, new-construction contemporary estate located in the highly coveted, gated enclave of Seven Isles. Built in 2024 by esteemed builder Jeff Hendricks, this 7,300± square-foot architectural showpiece offers seamless indoor-outdoor living, sophisticated design, and sweeping water views.</p><p><strong>Interior Elegance &amp; Craftsmanship</strong> A private gated entry opens into a breathtaking double-height foyer, showcasing exquisite Mosa White marble floors and custom Dayoris solid slab doors. The residence is an entertainer's dream, featuring a back-lit wet bar, multiple oversized balconies, and an accessible private elevator.</p><ul><li><p><strong>The Chef's Kitchen:</strong> A culinary masterpiece equipped with dual islands, premium Poggenpohl cabinetry, sleek Santa Margarita quartz, stunning book-matched Italian marble, and top-tier appliances.</p></li><li><p><strong>Luxurious Accommodations:</strong> The estate features 6 spacious en-suite bedrooms and 7.5 meticulously designed bathrooms. The primary suite offers the ultimate retreat with a private sitting area, a deep soaking tub, and a separate walk-in shower.</p></li><li><p><strong>Wellness &amp; Fitness:</strong> Enjoy your own private home gym, complete with a spa-like steam shower.</p></li></ul><p><strong>The Outdoor Oasis &amp; Boater's Paradise</strong> Step outside to a spectacular waterfront entertainment space, featuring 85 feet of prime canal frontage with direct ocean access and no fixed bridges.</p><ul><li><p><strong>Resort-Style Amenities:</strong> Lounge by the heated, in-ground saltwater pool, gather around the vapor fireplace, or host al-fresco dinners at the built-in summer kitchen.</p></li><li><p><strong>Private Dockage:</strong> A brand-new concrete dock includes a 16,000-lb boat lift, providing deepwater access for the avid boater.</p></li><li><p><strong>Ample Parking:</strong> The property boasts an impressive capacity for up to 8 vehicles, utilizing an expansive driveway and two separate 2-car garages (designed with the ceiling height to accommodate automotive lifts).</p></li></ul><p>Located just moments from Fort Lauderdale beach, this exceptional estate represents the pinnacle of South Florida waterfront living.</p>
        </div>
    </div>
    <div
        class="pt-6 bg-gradient-to-b from-black/10 from-0% to-black to-70% bg-blend-overlay absolute bottom-0 w-full">
        <button class="uppercase text-xs block w-full text-center" @click="expanded = ! expanded">
            <span x-text="expanded ? '- Less' : '+ More'">+ More</span>
        </button>
    </div>
</div>
                                
                <div class="space-y-6">
    <hr class="opacity-30 my-8">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Luxury Amenities</h2>
    <div class="py-2 flex gap-2">
        
    </div>
</div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:14,&quot;name&quot;:&quot;Boat Dock&quot;,&quot;slug&quot;:&quot;boat-dock&quot;,&quot;icon&quot;:&quot;fa-ship&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:41:35.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:41:35.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:14,&quot;order&quot;:0,&quot;created_at&quot;:&quot;2026-04-18T18:37:36.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-ship fa-fw fa-lg"></i>
    </div>
    <div>
        Boat Dock
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:3,&quot;name&quot;:&quot;Gated House&quot;,&quot;slug&quot;:&quot;gated-house&quot;,&quot;icon&quot;:&quot;fa-dungeon&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:11:37.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:11:37.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:3,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2026-04-18T18:37:40.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-dungeon fa-fw fa-lg"></i>
    </div>
    <div>
        Gated House
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:22,&quot;name&quot;:&quot;Hot Tub&quot;,&quot;slug&quot;:&quot;hot-tub&quot;,&quot;icon&quot;:&quot;fa-hot-tub-person&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:52:16.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:52:16.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:22,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2026-04-18T18:37:57.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-hot-tub-person fa-fw fa-lg"></i>
    </div>
    <div>
        Hot Tub
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:15,&quot;name&quot;:&quot;Heated Pool&quot;,&quot;slug&quot;:&quot;heated-pool&quot;,&quot;icon&quot;:&quot;fa-water-ladder&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:42:01.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:42:01.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:15,&quot;order&quot;:3,&quot;created_at&quot;:&quot;2026-04-18T18:37:59.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-water-ladder fa-fw fa-lg"></i>
    </div>
    <div>
        Heated Pool
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:9,&quot;name&quot;:&quot;Waterfront&quot;,&quot;slug&quot;:&quot;waterfront&quot;,&quot;icon&quot;:&quot;fa-water&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:16:25.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:16:25.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:9,&quot;order&quot;:4,&quot;created_at&quot;:&quot;2026-04-18T18:38:39.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-water fa-fw fa-lg"></i>
    </div>
    <div>
        Waterfront
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:8,&quot;name&quot;:&quot;Wi-Fi&quot;,&quot;slug&quot;:&quot;wi-fi&quot;,&quot;icon&quot;:&quot;fa-wifi&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:13:49.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:13:49.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:8,&quot;order&quot;:5,&quot;created_at&quot;:&quot;2026-04-18T18:38:41.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-wifi fa-fw fa-lg"></i>
    </div>
    <div>
        Wi-Fi
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:23,&quot;name&quot;:&quot;Spa&quot;,&quot;slug&quot;:&quot;spa&quot;,&quot;icon&quot;:&quot;fa-spa&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:52:43.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:52:43.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:23,&quot;order&quot;:6,&quot;created_at&quot;:&quot;2026-04-18T18:38:43.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-spa fa-fw fa-lg"></i>
    </div>
    <div>
        Spa
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:4,&quot;name&quot;:&quot;Pool&quot;,&quot;slug&quot;:&quot;pool&quot;,&quot;icon&quot;:&quot;fa-water-ladder&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:12:15.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:12:15.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:4,&quot;order&quot;:7,&quot;created_at&quot;:&quot;2026-04-18T18:38:45.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-water-ladder fa-fw fa-lg"></i>
    </div>
    <div>
        Pool
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:10,&quot;name&quot;:&quot;Laundry&quot;,&quot;slug&quot;:&quot;laundry&quot;,&quot;icon&quot;:&quot;fa-washing-machine&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:16:58.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:16:58.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:10,&quot;order&quot;:8,&quot;created_at&quot;:&quot;2026-04-18T18:38:50.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-washing-machine fa-fw fa-lg"></i>
    </div>
    <div>
        Laundry
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:7,&quot;name&quot;:&quot;Bathtub&quot;,&quot;slug&quot;:&quot;bathtub&quot;,&quot;icon&quot;:&quot;fa-bath&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:13:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:13:24.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:7,&quot;order&quot;:9,&quot;created_at&quot;:&quot;2026-04-18T18:38:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-bath fa-fw fa-lg"></i>
    </div>
    <div>
        Bathtub
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:6,&quot;name&quot;:&quot;BBQ Grill&quot;,&quot;slug&quot;:&quot;bbq-grill&quot;,&quot;icon&quot;:&quot;fa-grill&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:13:04.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:13:04.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:6,&quot;order&quot;:10,&quot;created_at&quot;:&quot;2026-04-18T18:39:13.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-grill fa-fw fa-lg"></i>
    </div>
    <div>
        BBQ Grill
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:17,&quot;name&quot;:&quot;Basketball Hoop&quot;,&quot;slug&quot;:&quot;basketball-hoop&quot;,&quot;icon&quot;:&quot;fa-basketball-hoop&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:44:20.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:44:20.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:17,&quot;order&quot;:11,&quot;created_at&quot;:&quot;2026-04-18T18:39:20.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-basketball-hoop fa-fw fa-lg"></i>
    </div>
    <div>
        Basketball Hoop
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:19,&quot;name&quot;:&quot;Jacuzzi&quot;,&quot;slug&quot;:&quot;jacuzzi&quot;,&quot;icon&quot;:&quot;fa-hot-tub-person&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:48:29.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:48:29.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:19,&quot;order&quot;:12,&quot;created_at&quot;:&quot;2026-04-18T18:40:17.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-hot-tub-person fa-fw fa-lg"></i>
    </div>
    <div>
        Jacuzzi
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:13,&quot;name&quot;:&quot;Mini-Bar&quot;,&quot;slug&quot;:&quot;mini-bar&quot;,&quot;icon&quot;:&quot;fa-martini-glass-empty&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:39:33.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:39:33.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:13,&quot;order&quot;:13,&quot;created_at&quot;:&quot;2026-04-18T18:40:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-martini-glass-empty fa-fw fa-lg"></i>
    </div>
    <div>
        Mini-Bar
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:18,&quot;name&quot;:&quot;Minutes from Beach&quot;,&quot;slug&quot;:&quot;minutes-from-beach&quot;,&quot;icon&quot;:&quot;fa-umbrella-beach&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:48:01.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:48:01.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:18,&quot;order&quot;:14,&quot;created_at&quot;:&quot;2026-04-18T18:40:27.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-umbrella-beach fa-fw fa-lg"></i>
    </div>
    <div>
        Minutes from Beach
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:21,&quot;name&quot;:&quot;Sunset View&quot;,&quot;slug&quot;:&quot;sunset-view&quot;,&quot;icon&quot;:&quot;fa-sunset&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:51:38.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:51:38.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:21,&quot;order&quot;:15,&quot;created_at&quot;:&quot;2026-04-18T18:40:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-sunset fa-fw fa-lg"></i>
    </div>
    <div>
        Sunset View
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:26,&quot;name&quot;:&quot;Fireplace&quot;,&quot;slug&quot;:&quot;fireplace&quot;,&quot;icon&quot;:&quot;fa-fireplace&quot;,&quot;created_at&quot;:&quot;2025-09-15T21:10:52.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T21:10:52.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:26,&quot;order&quot;:16,&quot;created_at&quot;:&quot;2026-04-18T18:40:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-fireplace fa-fw fa-lg"></i>
    </div>
    <div>
        Fireplace
    </div>
</div>
                    <div class="flex items-start gap-3 font-normal" amenity="{&quot;id&quot;:12,&quot;name&quot;:&quot;Gym&quot;,&quot;slug&quot;:&quot;gym&quot;,&quot;icon&quot;:&quot;fa-dumbbell&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:36:03.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:36:03.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:12,&quot;order&quot;:17,&quot;created_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-dumbbell fa-fw fa-lg"></i>
    </div>
    <div>
        Gym
    </div>
</div>
            </div>
    <div x-data="{
    modalIsOpen: false,
    updateResponsiveImages() {
        // Trigger responsive image sizing when modal opens
        if (this.modalIsOpen) {
            this.$nextTick(() => {
                const images = this.$el.querySelectorAll('img[srcset][onload]');
                images.forEach(img => {
                    // Re-trigger the image's onload handler
                    if (img.sizes === '1px' && img.onload) {
                        img.onload();
                    }
                });
            });
        }
    }
}" x-effect="updateResponsiveImages()">

            <button type="button"
        class="rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300" x-on:click="modalIsOpen = true">
        See all amenities
    </button>
    
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-lg flex-col bg-black rounded-2xl max-h-[90svh] overflow-hidden rounded-radius border border-zinc-50/30 w-4xl !max-w-full">
            <!-- Dialog Header -->
            <div
                class="flex items-center gap-4 justify-between border-outline bg-surface-alt/60 px-6 py-4 dark:border-outline-dark dark:bg-surface-dark/20">
                <h3 id=""
                    class="font-semibold tracking-wide text-white">
                    Amenities
                </h3>
                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-6 py-4 overflow-y-auto">
                <div class="space-y-8">
            <div class="space-y-3">
                <h3 class="text-lg font-normal uppercase">Luxury</h3>
                
                <ul role="list" class="grid grid-cols-3 gap-4">
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:14,&quot;name&quot;:&quot;Boat Dock&quot;,&quot;slug&quot;:&quot;boat-dock&quot;,&quot;icon&quot;:&quot;fa-ship&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:41:35.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:41:35.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:14,&quot;order&quot;:0,&quot;created_at&quot;:&quot;2026-04-18T18:37:36.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-ship fa-fw fa-lg"></i>
    </div>
    <div>
        Boat Dock
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:3,&quot;name&quot;:&quot;Gated House&quot;,&quot;slug&quot;:&quot;gated-house&quot;,&quot;icon&quot;:&quot;fa-dungeon&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:11:37.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:11:37.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:3,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2026-04-18T18:37:40.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-dungeon fa-fw fa-lg"></i>
    </div>
    <div>
        Gated House
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:22,&quot;name&quot;:&quot;Hot Tub&quot;,&quot;slug&quot;:&quot;hot-tub&quot;,&quot;icon&quot;:&quot;fa-hot-tub-person&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:52:16.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:52:16.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:22,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2026-04-18T18:37:57.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-hot-tub-person fa-fw fa-lg"></i>
    </div>
    <div>
        Hot Tub
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:15,&quot;name&quot;:&quot;Heated Pool&quot;,&quot;slug&quot;:&quot;heated-pool&quot;,&quot;icon&quot;:&quot;fa-water-ladder&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:42:01.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:42:01.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:15,&quot;order&quot;:3,&quot;created_at&quot;:&quot;2026-04-18T18:37:59.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-water-ladder fa-fw fa-lg"></i>
    </div>
    <div>
        Heated Pool
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:9,&quot;name&quot;:&quot;Waterfront&quot;,&quot;slug&quot;:&quot;waterfront&quot;,&quot;icon&quot;:&quot;fa-water&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:16:25.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:16:25.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:9,&quot;order&quot;:4,&quot;created_at&quot;:&quot;2026-04-18T18:38:39.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-water fa-fw fa-lg"></i>
    </div>
    <div>
        Waterfront
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:8,&quot;name&quot;:&quot;Wi-Fi&quot;,&quot;slug&quot;:&quot;wi-fi&quot;,&quot;icon&quot;:&quot;fa-wifi&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:13:49.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:13:49.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:8,&quot;order&quot;:5,&quot;created_at&quot;:&quot;2026-04-18T18:38:41.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-wifi fa-fw fa-lg"></i>
    </div>
    <div>
        Wi-Fi
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:23,&quot;name&quot;:&quot;Spa&quot;,&quot;slug&quot;:&quot;spa&quot;,&quot;icon&quot;:&quot;fa-spa&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:52:43.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:52:43.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:23,&quot;order&quot;:6,&quot;created_at&quot;:&quot;2026-04-18T18:38:43.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-spa fa-fw fa-lg"></i>
    </div>
    <div>
        Spa
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:4,&quot;name&quot;:&quot;Pool&quot;,&quot;slug&quot;:&quot;pool&quot;,&quot;icon&quot;:&quot;fa-water-ladder&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:12:15.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:12:15.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:4,&quot;order&quot;:7,&quot;created_at&quot;:&quot;2026-04-18T18:38:45.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-water-ladder fa-fw fa-lg"></i>
    </div>
    <div>
        Pool
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:10,&quot;name&quot;:&quot;Laundry&quot;,&quot;slug&quot;:&quot;laundry&quot;,&quot;icon&quot;:&quot;fa-washing-machine&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:16:58.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:16:58.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:10,&quot;order&quot;:8,&quot;created_at&quot;:&quot;2026-04-18T18:38:50.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-washing-machine fa-fw fa-lg"></i>
    </div>
    <div>
        Laundry
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:7,&quot;name&quot;:&quot;Bathtub&quot;,&quot;slug&quot;:&quot;bathtub&quot;,&quot;icon&quot;:&quot;fa-bath&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:13:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:13:24.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:7,&quot;order&quot;:9,&quot;created_at&quot;:&quot;2026-04-18T18:38:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-bath fa-fw fa-lg"></i>
    </div>
    <div>
        Bathtub
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:6,&quot;name&quot;:&quot;BBQ Grill&quot;,&quot;slug&quot;:&quot;bbq-grill&quot;,&quot;icon&quot;:&quot;fa-grill&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:13:04.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:13:04.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:6,&quot;order&quot;:10,&quot;created_at&quot;:&quot;2026-04-18T18:39:13.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-grill fa-fw fa-lg"></i>
    </div>
    <div>
        BBQ Grill
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:17,&quot;name&quot;:&quot;Basketball Hoop&quot;,&quot;slug&quot;:&quot;basketball-hoop&quot;,&quot;icon&quot;:&quot;fa-basketball-hoop&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:44:20.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:44:20.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:17,&quot;order&quot;:11,&quot;created_at&quot;:&quot;2026-04-18T18:39:20.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-basketball-hoop fa-fw fa-lg"></i>
    </div>
    <div>
        Basketball Hoop
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:19,&quot;name&quot;:&quot;Jacuzzi&quot;,&quot;slug&quot;:&quot;jacuzzi&quot;,&quot;icon&quot;:&quot;fa-hot-tub-person&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:48:29.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:48:29.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:19,&quot;order&quot;:12,&quot;created_at&quot;:&quot;2026-04-18T18:40:17.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-hot-tub-person fa-fw fa-lg"></i>
    </div>
    <div>
        Jacuzzi
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:13,&quot;name&quot;:&quot;Mini-Bar&quot;,&quot;slug&quot;:&quot;mini-bar&quot;,&quot;icon&quot;:&quot;fa-martini-glass-empty&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:39:33.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:39:33.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:13,&quot;order&quot;:13,&quot;created_at&quot;:&quot;2026-04-18T18:40:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-martini-glass-empty fa-fw fa-lg"></i>
    </div>
    <div>
        Mini-Bar
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:18,&quot;name&quot;:&quot;Minutes from Beach&quot;,&quot;slug&quot;:&quot;minutes-from-beach&quot;,&quot;icon&quot;:&quot;fa-umbrella-beach&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:48:01.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:48:01.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:18,&quot;order&quot;:14,&quot;created_at&quot;:&quot;2026-04-18T18:40:27.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-umbrella-beach fa-fw fa-lg"></i>
    </div>
    <div>
        Minutes from Beach
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:21,&quot;name&quot;:&quot;Sunset View&quot;,&quot;slug&quot;:&quot;sunset-view&quot;,&quot;icon&quot;:&quot;fa-sunset&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:51:38.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:51:38.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:21,&quot;order&quot;:15,&quot;created_at&quot;:&quot;2026-04-18T18:40:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-sunset fa-fw fa-lg"></i>
    </div>
    <div>
        Sunset View
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:26,&quot;name&quot;:&quot;Fireplace&quot;,&quot;slug&quot;:&quot;fireplace&quot;,&quot;icon&quot;:&quot;fa-fireplace&quot;,&quot;created_at&quot;:&quot;2025-09-15T21:10:52.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T21:10:52.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:26,&quot;order&quot;:16,&quot;created_at&quot;:&quot;2026-04-18T18:40:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-fireplace fa-fw fa-lg"></i>
    </div>
    <div>
        Fireplace
    </div>
</div>
                        </li>
                                            <li>
                            <div class="flex items-start gap-3 font-normal text-sm" amenity="{&quot;id&quot;:12,&quot;name&quot;:&quot;Gym&quot;,&quot;slug&quot;:&quot;gym&quot;,&quot;icon&quot;:&quot;fa-dumbbell&quot;,&quot;created_at&quot;:&quot;2025-09-15T20:36:03.000000Z&quot;,&quot;updated_at&quot;:&quot;2025-09-15T20:36:03.000000Z&quot;,&quot;pivot&quot;:{&quot;property_id&quot;:271,&quot;featured_amenity_id&quot;:12,&quot;order&quot;:17,&quot;created_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2026-04-18T18:40:56.000000Z&quot;}}">
    <div>
        <i class="fa-sharp fa-light fa-dumbbell fa-fw fa-lg"></i>
    </div>
    <div>
        Gym
    </div>
</div>
                        </li>
                                    </ul>
            </div>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
            </div>
            <!-- Dialog Footer -->
                    </div>
    </div>
</div>
</div>
                <div class="space-y-6">
    <hr class="opacity-30 my-8">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Aspen Mountain Chalet Details</h2>
    <div class="py-2 flex gap-2">
        
    </div>
</div>
    <div class="grid lg:grid-cols-2 gap-4">
        <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6 space-y-2">
    <div class="mb-4">
                    <i class="fa-sharp fa-light fa-comments fa-xl"></i>
                </div>
                <h3 class="font-semibold text-lg uppercase">Things to Know</h3>
                <div class="content-format">
                    <p>Smoking and Conduct Policies</p><p>• ㅤNo loud music after 10 PM</p><p>• ㅤNo smoking inside the property premises.</p><p>• ㅤParties are strictly not allowed here.</p><p>• ㅤAvoid creating excessive trash during stay.</p><p>Safety and Property Use</p><p>• ㅤFollow ocean rules if using the dock.</p><p>• ㅤSwimming in the canal&nbsp;is&nbsp;not&nbsp;allowed.</p>
                </div>
</div>
</article>
        <article class="relative text-sm group rounded-xl bg-zinc-800">
    <div class="p-6 space-y-2">
    <div class="mb-4">
                    <i class="fa-sharp fa-light fa-file-circle-info fa-xl"></i>
                </div>
                <h3 class="font-semibold text-lg uppercase">Villa Rules</h3>
                <div class="content-format">
                    <p>• ㅤDoors and windows must be closed &amp; locked.</p><p>• ㅤVisitors need manager's approval in advance</p><p>• ㅤLimit cars to the number listed above.</p><p>• ㅤStreet parking is strictly&nbsp;not&nbsp;allowed.</p>
                </div>
</div>
</article>
    </div>
</div>
                <div class="space-y-6">
    <hr class="opacity-30 my-8">
    <div class="flex justify-between">
    <h2 class="text-3xl uppercase font-normal">Located in </h2>
    <div class="py-2 flex gap-2">
        
    </div>
</div>

    <div class="rounded-2xl overflow-hidden">
        <div id="map" class="h-96 w-full"></div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('map').setView([39.1911, -106.8175], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            L.marker([39.1911, -106.8175]).addTo(map);
        });
    </script>
</div>
            </div>
            <div>
                <div
    id="tripPlanner"
    x-data="propertyPricing()"
    x-init="init()"
    @keydown.escape="showDatePicker = false; showGuestPicker = false"
    @click.outside="if (!$refs.datepicker?.contains($event.target)) { showDatePicker = false; } if (!$refs.guestpicker?.contains($event.target)) { showGuestPicker = false; }"
    class="sticky top-24 z-10"
>
    <div class="bg-zinc-900 rounded-xl border border-zinc-800 p-6">
        
        <div class="mb-6">
            <div class="flex items-baseline gap-1">
                <span
                    class="text-2xl font-semibold text-zinc-100">$7,500</span>
                <span class="text-zinc-400">night</span>
            </div>
        </div>

        
        <div class="mb-4 relative">
            <div class="grid grid-cols-2 border border-zinc-700 rounded-lg">
                <button
                    class="p-3 text-left border-r border-zinc-700 hover:bg-zinc-800 transition-colors"
                    @click="openDatePicker('from')"
                >
                    <div class="text-xs font-semibold uppercase text-zinc-500">Check-in</div>
                    <div class="text-sm text-zinc-200" x-text="dateFrom ? dateFrom.toLocaleDateString('en-US', {month:'short', day:'numeric'}) : 'Add date'"></div>
                </button>
                <button
                    class="p-3 text-left hover:bg-zinc-800 transition-colors"
                    @click="openDatePicker('to')"
                >
                    <div class="text-xs font-semibold uppercase text-zinc-500">Checkout</div>
                    <div class="text-sm text-zinc-200" x-text="dateTo ? dateTo.toLocaleDateString('en-US', {month:'short', day:'numeric'}) : 'Add date'"></div>
                </button>
            </div>

            
            <button
                class="w-full mt-2 p-3 text-left border border-zinc-700 rounded-lg hover:bg-zinc-800 transition-colors"
                @click="showGuestPicker = !showGuestPicker; showDatePicker = false"
            >
                <div class="text-xs font-semibold uppercase text-zinc-500">Guests</div>
                <div class="text-sm text-zinc-200" x-text="guests + ' guests'"></div>
            </button>


            
            <div
                x-ref="guestpicker"
                x-show="showGuestPicker"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute z-10 mt-2 w-full bg-zinc-900 rounded-lg shadow-xl border border-zinc-800 p-4"
            >
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-medium text-zinc-100">Guests</div>
                        <div class="text-sm text-zinc-400">Maximum 12</div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button
                            class="w-8 h-8 rounded-full border border-zinc-700 flex items-center justify-center hover:border-zinc-600 disabled:opacity-50 disabled:cursor-not-allowed text-zinc-300"
                            :disabled="guests <= 1"
                            @click="if(guests > 1) guests--"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 12H4"></path>
                            </svg>
                        </button>
                        <span class="w-8 text-center font-medium text-zinc-100" x-text="guests">2</span>
                        <button
                            class="w-8 h-8 rounded-full border border-zinc-700 flex items-center justify-center hover:border-zinc-600 disabled:opacity-50 disabled:cursor-not-allowed text-zinc-300"
                            :disabled="guests >= 20"
                            @click="if(guests < 20) guests++"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            
            <div
                x-ref="datepicker"
                x-show="showDatePicker"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute z-10 mt-2 bg-zinc-900 rounded-lg shadow-xl border border-zinc-800 p-6 left-0 right-0"
            >
                <input type="hidden" name="date_from" x-model="dateFromYmd">
                <input type="hidden" name="date_to" x-model="dateToYmd">

                <label for="datepicker" class="font-medium mb-1 text-zinc-50 block">Select Date Range</label>

                
                <div class="flex flex-col items-center">
                    <div class="w-full flex justify-between items-center mb-2 border-b border-zinc-200/30 py-1">
                        <button type="button"
                                class="size-8 transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-zinc-700 p-1 rounded-md"
                                @click="previousMonth()">
                            <svg class="size-6 text-zinc-50 inline-flex" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <div class="grow text-center">
                            <span x-text="MONTH_NAMES[month]" class="text-sm font-normal text-zinc-50"></span>
                            <span x-text="year" class="ml-1 text-sm text-zinc-50 font-normal"></span>
                        </div>
                        <button type="button"
                                class="size-8 transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-zinc-700 p-1 rounded-md"
                                @click="nextMonth()">
                            <svg class="h-6 w-6 text-zinc-50 inline-flex" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    
                    <div class="grid grid-cols-7 mb-3">
                        <template x-for="(day, index) in DAYS" :key="index">
                            <div class="text-zinc-200 font-normal text-center text-xs px-1">
                                <span x-text="day"></span>
                            </div>
                        </template>
                    </div>

                    
                    <div class="grid grid-cols-7">
                        <template x-for="blankday in blankdays">
                            <div class="text-center p-1 text-sm"></div>
                        </template>
                        <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                            <div>
                                <div
                                    @click="getDateValue(date, false)"
                                    @mouseover="getDateValue(date, true)"
                                    x-text="date"
                                    class="p-1.5 cursor-pointer text-center text-sm transition ease-in-out duration-100"
                                    :class="{
                                        'font-bold': isToday(date),
                                        'bg-white text-black rounded-l-md': isDateFrom(date),
                                        'bg-white text-black rounded-r-md': isDateTo(date),
                                        'bg-amber-100 text-black': isInRange(date) && !isUnavailable(date),
                                        'text-zinc-600 line-through cursor-not-allowed': isUnavailable(date),
                                        'text-zinc-300': !isUnavailable(date) && !isDateFrom(date) && !isDateTo(date) && !isInRange(date)
                                    }">
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="flex justify-between items-center mt-4 pt-3 border-t border-zinc-800">
                        <button type="button" @click="dateFrom = null; dateTo = null; dateFromYmd = ''; dateToYmd = ''; selecting = false;" class="text-sm text-zinc-400 hover:text-white underline underline-offset-4 decoration-zinc-600 transition-colors">Clear dates</button>
                        <button type="button" @click="showDatePicker = false" class="bg-white text-black px-5 py-2 rounded-lg text-sm font-medium hover:bg-zinc-200 transition-colors">Done</button>
                    </div>
                </div>
            </div>
        </div>

        <!--[if BLOCK]><![endif]-->            <!--[if BLOCK]><![endif]-->    <button type="button"
        class="flex items-center justify-center rounded-md bg-zinc-50 px-2.5 py-2.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 w-full">
        Reserve
    </button>
<!--[if ENDBLOCK]><![endif]-->            
            
            
            
            
        <!--[if ENDBLOCK]><![endif]-->
        <a href="/contact"
           class="block text-center w-full mt-2 rounded-md border cursor-pointer border-zinc-50/30 text-zinc-50 px-2.5 py-1.5 text-sm font-normal shadow-xs transition-all aria-expanded:bg-amber-50 aria-expanded:text-black hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300">
            Request Information
        </a>

        <!--[if BLOCK]><![endif]-->            <p class="text-sm text-center text-zinc-500 mt-4">You won't be charged yet</p>
        <!--[if ENDBLOCK]><![endif]-->
        
        <!--[if BLOCK]><![endif]-->            <div class="mt-4 pt-4 border-t border-zinc-800">
                <div class="text-sm text-zinc-300">
                    <span class="font-medium">Refundable Security Deposit:</span>
                    <!--[if BLOCK]><![endif]-->                        $5,000 will be collected at time of booking.
                    <!--[if ENDBLOCK]><![endif]-->                </div>
            </div>
        <!--[if ENDBLOCK]><![endif]-->
        
        <div class="mt-4 pt-4 border-t border-zinc-800">
            <div class="text-xs text-zinc-400 leading-relaxed">
                <p class="mb-2">50% payment due at booking. Pricing is subject to change during holidays and special
                    events.</p>
                <p class="mb-2">For guests paying by wire transfer, your booking will only be confirmed once the payment
                    is received.</p>
                <p>For those using credit cards, you will be subject to a 3% processing fee once Luxuri confirms your
                    booking.</p>
            </div>
        </div>
    </div>

    
    <script>
        const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        document.addEventListener('alpine:init', () => {
            Alpine.data('propertyPricing', () => ({
                showDatePicker: false,
                showGuestPicker: false,
                dateFromYmd: '',
                dateToYmd: '',
                dateFrom: null,
                dateTo: null,
                currentDate: null,
                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                guests: 2,
                selecting: false,
                endToShow: '',
                month2: '',
                year2: '',
                blankdays2: [],
                no_of_days2: [],
                unavailableDates: [],
                minNights: 1,
                maxNights: 365,

                convertFromYmd(dateYmd) {
                    if (!dateYmd) return null;
                    const year = Number(dateYmd.substr(0, 4));
                    const month = Number(dateYmd.substr(5, 2)) - 1;
                    const date = Number(dateYmd.substr(8, 2));
                    return new Date(year, month, date);
                },

                convertToYmd(dateObject) {
                    const year = dateObject.getFullYear();
                    const month = dateObject.getMonth() + 1;
                    const date = dateObject.getDate();
                    return year + '-' + ('0' + month).slice(-2) + '-' + ('0' + date).slice(-2);
                },

                init() {
                    this.currentDate = new Date();
                    const currentMonth = this.currentDate.getMonth();
                    const currentYear = this.currentDate.getFullYear();
                    this.month = currentMonth;
                    this.year = currentYear;
                    this.syncSecondMonth();
                    this.getNoOfDays();
                },

                openDatePicker(end) {
                    this.endToShow = end;
                    this.showDatePicker = true;
                    this.showGuestPicker = false;
                    this.selecting = false;
                    if (end === 'from' && this.dateFrom) {
                        this.currentDate = this.dateFrom;
                    } else if (end === 'to' && this.dateTo) {
                        this.currentDate = this.dateTo;
                    } else {
                        this.currentDate = new Date();
                    }
                    this.month = this.currentDate.getMonth();
                    this.year = this.currentDate.getFullYear();
                    this.syncSecondMonth();
                    this.getNoOfDays();
                },

                syncSecondMonth() {
                    this.month2 = (this.month + 1) % 12;
                    this.year2 = this.year + (this.month === 11 ? 1 : 0);
                },

                previousMonth() {
                    if (this.month === 0) { this.year--; this.month = 11; }
                    else { this.month--; }
                    this.syncSecondMonth();
                    this.getNoOfDays();
                },

                nextMonth() {
                    if (this.month === 11) { this.year++; this.month = 0; }
                    else { this.month++; }
                    this.syncSecondMonth();
                    this.getNoOfDays();
                },

                isToday(date, isSecondMonth = false) {
                    const today = new Date();
                    const y = isSecondMonth ? this.year2 : this.year;
                    const m = isSecondMonth ? this.month2 : this.month;
                    const d = new Date(y, m, date);
                    return today.toDateString() === d.toDateString();
                },

                isDateFrom(date, isSecondMonth = false) {
                    if (!this.dateFrom) return false;
                    const y = isSecondMonth ? this.year2 : this.year;
                    const m = isSecondMonth ? this.month2 : this.month;
                    const d = new Date(y, m, date);
                    return d.getTime() === this.dateFrom.getTime();
                },

                isDateTo(date, isSecondMonth = false) {
                    if (!this.dateTo) return false;
                    const y = isSecondMonth ? this.year2 : this.year;
                    const m = isSecondMonth ? this.month2 : this.month;
                    const d = new Date(y, m, date);
                    return d.getTime() === this.dateTo.getTime();
                },

                isInRange(date, isSecondMonth = false) {
                    if (!this.dateFrom || !this.dateTo) return false;
                    const y = isSecondMonth ? this.year2 : this.year;
                    const m = isSecondMonth ? this.month2 : this.month;
                    const d = new Date(y, m, date);
                    return d > this.dateFrom && d < this.dateTo;
                },

                isUnavailable(date, isSecondMonth = false) {
                    const y = isSecondMonth ? this.year2 : this.year;
                    const m = isSecondMonth ? this.month2 : this.month;
                    const dateStr = y + '-' + ('0' + (m + 1)).slice(-2) + '-' + ('0' + date).slice(-2);
                    return this.unavailableDates.includes(dateStr);
                },

                outputDateValues() {
                    if (this.dateFrom) this.dateFromYmd = this.convertToYmd(this.dateFrom);
                    if (this.dateTo) this.dateToYmd = this.convertToYmd(this.dateTo);
                },

                closeDatepicker() {
                    this.endToShow = '';
                    this.showDatePicker = false;
                },

                getDateValue(date, temp, isSecondMonth = false) {
                    if (temp && !this.selecting) return;
                    if (this.isUnavailable(date, isSecondMonth)) return;

                    const y = isSecondMonth ? this.year2 : this.year;
                    const m = isSecondMonth ? this.month2 : this.month;
                    let selectedDate = new Date(y, m, date);

                    if (this.endToShow === 'from') {
                        this.dateFrom = selectedDate;
                        if (!this.dateTo) { this.dateTo = selectedDate; }
                        else if (selectedDate > this.dateTo) {
                            this.endToShow = 'to';
                            this.dateFrom = this.dateTo;
                            this.dateTo = selectedDate;
                        }
                    } else if (this.endToShow === 'to') {
                        this.dateTo = selectedDate;
                        if (!this.dateFrom) { this.dateFrom = selectedDate; }
                        else if (selectedDate < this.dateFrom) {
                            this.endToShow = 'from';
                            this.dateTo = this.dateFrom;
                            this.dateFrom = selectedDate;
                        }
                    }

                    if (!temp) {
                        if (this.selecting) {
                            this.outputDateValues();
                            this.closeDatepicker();
                        }
                        this.selecting = !this.selecting;
                    }
                },

                getNoOfDays() {
                    let dim = new Date(this.year, this.month + 1, 0).getDate();
                    let dow = new Date(this.year, this.month).getDay();
                    this.blankdays = Array.from({length: dow}, (_, i) => i + 1);
                    this.no_of_days = Array.from({length: dim}, (_, i) => i + 1);

                    let dim2 = new Date(this.year2, this.month2 + 1, 0).getDate();
                    let dow2 = new Date(this.year2, this.month2).getDay();
                    this.blankdays2 = Array.from({length: dow2}, (_, i) => i + 1);
                    this.no_of_days2 = Array.from({length: dim2}, (_, i) => i + 1);
                },
            }));
        });
    </script>
    <div
        class="lg:hidden fixed bottom-0 start-0 end-0 z-50 w-full p-5 bg-black/70 border border-zinc-50/90 backdrop-blur-[2px] rounded-xl">
        <div class="flex gap-2">
            <div class="grow w-full">
                <div class="flex items-baseline gap-1">
                    <span
                        class="text-lg font-semibold text-zinc-100">$7,500</span>
                    <span class="text-zinc-400">night</span>
                </div>
                <div class="flex gap-1.5 text-xs">
                    <!--[if BLOCK]><![endif]-->                        <a href="#tripPlanner"
                           class="text-zinc-100 block">Select your dates
                        </a>
                    <!--[if ENDBLOCK]><![endif]-->                </div>
            </div>
                        <!--[if BLOCK]><![endif]-->                <!--[if BLOCK]><![endif]-->    <a href="tel:+13056453336"
        class="flex items-center justify-center rounded-md px-2.5 py-2.5 text-sm font-semibold border border-zinc-50/30 text-zinc-50 shadow-xs transition-all hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 size-[47px] shrink-0" title="+1 (305) 645-3336">
        <i class="fa-sharp fa-light fa-phone"></i>
    </a>
<!--[if ENDBLOCK]><![endif]-->
            <!--[if ENDBLOCK]><![endif]-->            <!--[if BLOCK]><![endif]-->                <!--[if BLOCK]><![endif]-->    <a href="#tripPlanner"
        class="flex items-center justify-center rounded-md bg-zinc-50 px-2.5 py-2.5 text-sm font-semibold text-black shadow-xs transition-all hover:bg-amber-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-300 shrink-0 min-w-17.5">
        Plan
    </a>
<!--[if ENDBLOCK]><![endif]-->            <!--[if ENDBLOCK]><![endif]-->        </div>
    </div>
            </div>
        </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- Gallery Modal -->
<div x-data="galleryModal()" @open-gallery-modal.window="open($event.detail.mediaId)" class="contents">
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 backdrop-blur-none"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-trap.inert.noscroll="isOpen"
         @keydown.escape.window="close()" @click.self="close()"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md"
         role="dialog" aria-modal="true" x-cloak>

        <div x-show="isOpen"
             x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative md:w-[90%] max-w-7xl h-[90vh] flex flex-col bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-800 shrink-0">
                <h3 class="text-xl font-semibold text-zinc-100">Aspen Mountain Chalet Gallery</h3>
                <button @click="close()" class="p-2 hover:bg-zinc-800 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 text-zinc-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Main Image -->
            <div class="flex-1 relative flex items-center justify-center bg-black overflow-hidden">
                <button @click="prev()" class="absolute left-4 z-10 p-2 bg-black/50 hover:bg-black/70 rounded-full text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <img :src="images[selectedIndex].url" :alt="images[selectedIndex].alt"
                     class="max-h-full max-w-full object-contain">

                <button @click="next()" class="absolute right-4 z-10 p-2 bg-black/50 hover:bg-black/70 rounded-full text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Thumbnails -->
            <div class="shrink-0 h-20 px-4 py-2 bg-zinc-900 border-t border-zinc-800 overflow-x-auto no-scrollbar"
                 x-effect="$nextTick(() => { const container = $el; const active = container.children[0]?.children[selectedIndex]; if(active) active.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' }); })">
                <div class="flex gap-2 h-full items-center">
                    <template x-for="(image, index) in images" :key="index">
                        <button @click="selectedIndex = index"
                                class="h-14 w-20 flex-shrink-0 rounded-md overflow-hidden transition-all border-2"
                                :class="selectedIndex === index ? 'border-amber-500 opacity-100 scale-105' : 'border-transparent opacity-50 hover:opacity-90'">
                            <img :src="image.thumb" :alt="image.alt" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function galleryModal() {
        return {
            isOpen: false,
            selectedIndex: 0,
            images: [
                { id: 14731, url: 'https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/IMG_3.jpg', thumb: 'https://media.luxuri.com/973913ee2bd47d7853209f89595b9ac9/responsive-images/IMG_3___media_library_original_640_424.jpg', alt: 'IMG_3' },
                { id: 14730, url: 'https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/IMG_2.jpg', thumb: 'https://media.luxuri.com/feb10f78d74cc479e8c1a713fd87d9e0/responsive-images/IMG_2___media_library_original_640_424.jpg', alt: 'IMG_2' },
                { id: 14811, url: 'https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/IMG_78.jpg', thumb: 'https://media.luxuri.com/f7b39e37eceee71b67db34b32f17756c/responsive-images/IMG_78___media_library_original_640_427.jpg', alt: 'IMG_78' },
                { id: 14746, url: 'https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/IMG_13.jpg', thumb: 'https://media.luxuri.com/bbd99eac71451b94515bcc89a6acdded/responsive-images/IMG_13___media_library_original_640_427.jpg', alt: 'IMG_13' },
                { id: 14740, url: 'https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/IMG_8.jpg', thumb: 'https://media.luxuri.com/cb61d96f68cbe12ee1fd113d701a3dc6/responsive-images/IMG_8___media_library_original_640_427.jpg', alt: 'IMG_8' }
            ],
            open(mediaId) {
                if (mediaId) {
                    const idx = this.images.findIndex(img => img.id === mediaId);
                    if (idx !== -1) this.selectedIndex = idx;
                }
                this.isOpen = true;
            },
            close() { this.isOpen = false; },
            next() { this.selectedIndex = (this.selectedIndex + 1) % this.images.length; },
            prev() { this.selectedIndex = (this.selectedIndex - 1 + this.images.length) % this.images.length; }
        }
    }
</script>
</main>
@endsection