<template>
	<header class="text-center bg-blue-800 text-white p-4 mb-10">
		<div class="text-3xl md:text-5xl font-bold mb-3">
		<i class="fa fa-viruses"></i> {{ election }}
		</div>

		<!-- <p>
			Click here 
			<Link class="text-blue-300" :href="route('dashboard')">go back to dashboard</Link>
		</p> -->
	</header>
	<main>
		<div class="mx-auto px-10">
			<!-- <div class="px-10 py-6 text-center">
				<h2 class="text-7xl font-bold text-gray-900 uppercase"> -->
					<!--	{{ election }}  Display the election currently viewing -->
					<!-- <br>ELECTION RESULT
				</h2>
			</div> -->

			<div class="column-8">
				<div class="w-full px-4 sm:px-6 lg:px-8 mb-5">
					<!-- <div class="sm:flex sm:items-center">
						<div class="sm:flex-auto">
							<h1 class="text-xl font-semibold text-gray-900">Realtime Result</h1>
						</div>
					</div> -->
					<div class="mt-5 flex flex-col">
						<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
							<div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
								<div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5">
									<table class="min-w-full divide-y divide-gray-300">
										<thead class="bg-gray-50">
											<tr>
												<th scope="col" class="py-3 pl-4 pr-3 text-left text-2xl font-medium uppercase tracking-wide text-gray-500 sm:pl-6">
													Party</th>
												<th scope="col" class="px-3 py-3 text-left text-2xl font-medium uppercase tracking-wide text-gray-500">
													Votes</th>
											</tr>
										</thead>
										<tbody class="divide-y divide-gray-200 bg-white">
											<tr v-for="row in result" :key="row.party_id">
												<td class="whitespace-nowrap py-4 pl-4 pr-3 md:text-7xl text-3xl font-medium text-gray-900 sm:pl-6">{{ row.party.party_name }}</td>
												<td class="whitespace-nowrap px-3 py-4 md:text-7xl text-3xl text-gray-500">{{ row.votes }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<InertiaLink href="post">Post page</InertiaLink>
			<!-- <div class="column-4">
				<div class="w-full px-4 sm:px-6 lg:px-8">
					<h1 class="text-xl font-semibold text-gray-900">Polling Units Statistics</h1>
					<dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
						<div v-for="item in stats" :key="item.name" class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
							<dt class=" text-2xl font-medium text-gray-500 truncate">
								{{ item.name }}
							</dt>
							<dd class="mt-1 text-3xl font-semibold text-gray-900">
								{{ item.stat }}
							</dd>
						</div>
					</dl>
				</div>
			</div> -->
		</div>
	</main>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
	mounted() {
		this.realTimeResult()
	},
	data() {
		return {
			// stats: [
			// 	{ name: 'Total', stat: '1034' },
			// 	{ name: 'Concluded', stat: '595' },
			// 	{ name: 'Ongoing', stat: '334' },
			// 	{ name: 'Cancel', stat: '2' },
			// ],

			// RESULT ARRAY
			result: [],
			// END RESULT ARRAY
			election: 'GOMBE STATE SOUTH GUBERNATORIAL ELECTION',
		}
	},
	methods: {
		fetchResult(){
			axios.get('/resultapi').then(response => {
				this.result = response.data;
			})
		},
		realTimeRefresh(e){
			axios.get('/resultapi').then(response => {
				this.result = response.data;
				this.$Notice.success({title: 'Result Updated'})
			})
		},
		realTimeResult(){
			window.Echo.channel('notify').listen('PushResult', (msg) => {
				this.realTimeRefresh(msg)
			})
		}
	},
	created() {
		this.fetchResult()
	},
}
</script>