function calc(str) {
	if (typeof str !== "string") { // если передается не строка
		console.log(str, "is not a string");
		return null;
	} else {
		if (str.length < 5) { // если передается строка без пробела/пробелов
			console.log("'%s' is bad expression", str);
			return null;
		} else {
			if (!checkBracketsCount(str)) { // разное количество '(' и ')'
				console.log('bad count of brackets');
				return null;
			} else {
				// tst(str);
				// return 0;
				return handle(str);
			}	
		}
	}
}

function tst(arg) {
	let arr1 = [1,2,3,4]
	console.log(arr1.slice(1,-1))
	let arr2 = arr1.slice(1,-1)
	console.log(arr2)
}

function handle(arg) {
	let arr = arg.split(' ');
	const operators = ['+', '-', '/', '*'];
	let operator = null;
	let operand1 = null;
	let operand2 = null;
	let tmpArrOp1 = [];
	let tmpArrOp2 = [];
	let searchingOperand1 = false;
	let searchingOperand2 = false;
	let bracketsCounter1 = 0;
	let bracketsCounter2 = 0;
	for(let i of arr) {
		if (operator === null) {
			if (operators.includes(i)) operator = i;
		} else {
			if (!operand1) { // поиск 1 операнда
				if (searchingOperand1) { //добавление нужного количества элементов в массив
					tmpArrOp1.push(i);
					if (i.startsWith('(')) {
						bracketsCounter1++;
					} else {
						if (i.endsWith(')')) {
							if (checkBracketsCountForSearchingOperand(i, bracketsCounter1)) {
								operand1 = handle(tmpArrOp1.join(' ').slice(1,-1));
							}
						}
					}
				} else {
					operand1 = parseFloat(i);
					if (!operand1) {
						searchingOperand1 = true;
						if (i.startsWith('(')) {
							tmpArrOp1.push(i);
							bracketsCounter1++;
						} else {
							console.log('bad input');
							return null; //начинается не с '(' и это не число
						}
					}
				}
			} else { // поиск 2 операнда
				if (searchingOperand2) { //добавление нужного количества элементов в массив
					tmpArrOp2.push(i);
					if (i.startsWith('(')) {
						bracketsCounter2++;
					} else {
						if (i.endsWith(')')) {
							if (checkBracketsCountForSearchingOperand(i, bracketsCounter2)) {
								operand2 = handle(tmpArrOp2.join(' ').slice(1,-1));
							}
						}
					}
				} else {
					operand2 = parseFloat(i);
					if (!operand2) {
						searchingOperand2 = true;
						if (i.startsWith('(')) {
							tmpArrOp2.push(i);
							bracketsCounter2++;
						} else {
							console.log('bad input');
							return null; //начинается не с '(' и это не число
						}
					}
				}
			}
		}
	}
	return execOperation(operator, operand1, operand2);
}

function execOperation(operator, operand1, operand2) {
	if (operator === null || operand1 === null || operand2 === null) {
		return null;
	} else {
		switch (operator) {
			case '+':
				return operand1 + operand2;
				break;

			case '-':
				return operand1 - operand2;
				break;

			case '*':
				return operand1 * operand2;
				break;

			case '/':
				return operand1 / operand2;
				break;

			default:
				return null;
				console.log('smthg going wrond');
		}
	}
}

function checkBracketsCountForSearchingOperand(arrElement, bracketsCount) {
	let tmpCounter = 0;
	for(let i = arrElement.length - 1; i >= 0; i--) {
		if (arrElement[i] === ')') {
			tmpCounter++;
		} else {
			break;
		}
	}
	if (tmpCounter === bracketsCount) {
		return true;
	} else {
		return false;
	}
}

function checkBracketsCount(arg) {
	let countOpenBracket = 0;
	let countCloseBracket = 0;
	for(let i = 0; i < arg.length; i++) {
		if (arg[i] === '(') countOpenBracket++;
		if (arg[i] === ')') countCloseBracket++;
	}
	if (countOpenBracket === countCloseBracket) { // почему не работает тернарный оператор?
		return true;
	} else {
		return false;
	}
}