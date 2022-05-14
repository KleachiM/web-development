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
	let arr = arg.split(' ');
	console.log(arr.length)
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

	let openedBracketsCounter1 = 0;
	let closedBracketsCounter1 = 0;

	let openedBracketsCounter2 = 0;
	let closedBracketsCounter2 = 0;

	for(let i of arr) {
		if (operator === null) {
			if (operators.includes(i)) operator = i;
		} else {
			if (!operand1) { // поиск 1 операнда
				if (searchingOperand1) { //добавление нужного количества элементов в массив
					tmpArrOp1.push(i);
					if (i.startsWith('(')) {
						openedBracketsCounter1++;
					} else {
						if (i.endsWith(')')) {
							closedBracketsCounter1 = findClosedBrackets(i, closedBracketsCounter1);
							if (openedBracketsCounter1 === closedBracketsCounter1) {
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
							openedBracketsCounter1++;
						} else {
							console.log('bad input');
							return null; //начинается не с '(' и это не число
						}
					}
				}
			} else { // поиск 2 операнда
				if (!operand2){
					if (searchingOperand2) { //добавление нужного количества элементов в массив
						tmpArrOp2.push(i);
						if (i.startsWith('(')) {
							openedBracketsCounter2++;
						} else {
							if (i.endsWith(')')) {
								closedBracketsCounter2 = findClosedBrackets(i, closedBracketsCounter2);
								if (openedBracketsCounter2 === closedBracketsCounter2) {
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
								openedBracketsCounter2++;
							} else {
								console.log('bad input');
								return null; //начинается не с '(' и это не число
							}
						}
					}
				} else { // найден 2 операнд, если остались элементы в массиве - ошибка
					console.log('too much arguments');
					return null;
				}
				
			}
		}
	}
	// if (operand3) {
	// 	console.log('bad count of operands');
	// 	return null;
	// }
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

function findClosedBrackets(arrElement, closedBracketsCounter) {
	for(let i = arrElement.length - 1; i >= 0; i--) {
		if (arrElement[i] === ')') closedBracketsCounter++;
	}
	return closedBracketsCounter;
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