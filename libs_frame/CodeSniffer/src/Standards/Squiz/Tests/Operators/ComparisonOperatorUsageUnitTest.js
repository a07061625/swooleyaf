if (value === TRUE) {
} elseif (value === FALSE) {
}

if (value == TRUE) {
} elseif (value == FALSE) {
}

if (value) {
} elseif (!value) {
}

if (value.isSomething === TRUE) {
} elseif (myFunction(value) === FALSE) {
}

if (value.isSomething == TRUE) {
} elseif (myFunction(value) == FALSE) {
}

if (value.isSomething) {
} elseif (!myFunction(value)) {
}

if (value === TRUE || other === FALSE) {
}

if (value == TRUE || other == FALSE) {
}

if (value || !other) {
}

if (one === TRUE || two === TRUE || three === FALSE || four === TRUE) {
}

if (one || two || !three || four) {
}

while (one == true) {
}

while (one === true) {
}

do {
} while (one == true);

do {
} while (one === true);

for (one = 10; one != 0; one--) {
}

for (one = 10; one !== 0; one--) {
}

for (type in types) {
}

variable = (variable2 === true) ? variable1 : "foobar";

variable = (variable2 == true) ? variable1 : "foobar";

variable = (variable2 === false) ? variable1 : "foobar";

variable = (variable2 == false) ? variable1 : "foobar";

variable = (variable2 === 0) ? variable1 : "foobar";

variable = (variable2 == 0) ? variable1 : "foobar";
