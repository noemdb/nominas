const yargs = require("yargs/yargs")(process.argv.slice(2));
const { ComputeEngine } = require("@cortex-js/compute-engine");

const ce = new ComputeEngine();

const argv = yargs
    .option("latex", {
        alias: "l",
        type: "string",
        demandOption: true,
    })
    .option("variables", {
        alias: "v",
        type: "array",
        demandOption: true,
        coerce: (arg) => {
            const values = {};
            arg.forEach((item) => {
                const [key, value] = item.split("=");
                values[key] = value;
            });
            return values;
        },
    }).argv;

const { latex, variables } = argv;

console.log(ce.parse(latex).subs(variables).N().valueOf());
