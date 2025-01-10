<div x-data="app()" x-cloak class="">
  <div class="shadow p-4 rounded-lg dark:bg-gray-800 bg-white">
      <div class="md:flex md:justify-between md:items-center">
          <div>
              <h2 class="text-xl font-bold dark:text-gray-100 text-gray-800 leading-tight">Peminjaman Kendaraan</h2>
              <p class="mb-2 text-sm dark:text-gray-400 text-gray-600 flex items-center">
                  Statistik Bulanan
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
              </p>
          </div>
          <!-- Legends -->
          <div class="flex items-center">
              <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
              <div class="text-sm dark:text-gray-300 text-gray-700">Jumlah Peminjaman</div>
          </div>
      </div>

      <!-- Grafik -->
      <div class="line my-8 relative">
          <!-- Tooltip -->
          <template x-if="tooltipOpen">
              <div x-ref="tooltipContainer" 
                   class="p-2 z-10 shadow-lg rounded-lg absolute bg-white dark:bg-gray-700"
                   :style="`bottom: ${tooltipY}px; left: ${tooltipX}px`">
                  <div class="text-sm font-medium text-gray-800 dark:text-gray-100">
                      <span x-html="tooltipContent"></span>
                  </div>
              </div>
          </template>

          <!-- Bar Chart -->
          <div class="flex -mx-1 items-end mb-2">
              <template x-for="data in chartData">
                  <div class="px-4 w-1/12">
                      <div :style="`height: ${data * 10}px`" 
                           class="transition ease-in duration-200 bg-blue-600 hover:bg-blue-400 dark:bg-blue-500 relative">
                          <div x-text="data" 
                               class="absolute top-0 left-0 right-0 -mt-6 text-sm font-medium dark:text-gray-300 text-gray-800"></div>
                      </div>
                  </div>
              </template>
          </div>

          <!-- Labels -->
          <div class="flex -mx-1 items-end">
              <template x-for="label in labels">
                  <div class="px-1 w-1/12">
                      <div class="text-center text-sm dark:text-gray-300 text-gray-700" x-text="label"></div>
                  </div>
              </template>
          </div>
      </div>
  </div>
</div>

<script>
  function app() {
      return {
          chartData: [19, 22, 18, 20, 19, 20, 16, 15, 15, 16, 17, 18],
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ags', 'Sep', 'Oct', 'Nov', 'Dec'],

          tooltipContent: '',
          tooltipOpen: false,
          tooltipX: 0,
          tooltipY: 0,
          showTooltip(e) {
              this.tooltipContent = e.target.textContent;
              this.tooltipX = e.target.offsetLeft - e.target.clientWidth / 2;
              this.tooltipY = e.target.clientHeight + 10;
          },
          hideTooltip() {
              this.tooltipOpen = false;
              this.tooltipContent = '';
          }
      }
  }
</script>