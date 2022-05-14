function isPrimeNumber(n) {
	if (typeof n === 'number') {		
		isPrimeNumberFunc(n);
	} else {
		if (Array.isArray(n)) {
			for (let i of n) {
				isPrimeNumberFunc(i);
			} 
		} else {
				console.log(n, 'not number/array');
			}
	}
}

function isPrimeNumberFunc(n) {
	if (n > 0) {
		if (Number.isInteger(n)) {
			let isPrime;
			for (let i = 2; i <= n; i++) {
				isPrime = true;
				for (let j = 2; j < i; j++) {
					if (i % j == 0) {
						isPrime = false;
						break;
					}
				}
			}
			if (isPrime) {
				console.log('%i is prime number', n);
			} else {
				console.log('%i not prime number', n);
			}
		} else {
			console.log('%s is not integer', n);
		}
	} else {
		console.log('%f must be greater than 0', n);
	}
}