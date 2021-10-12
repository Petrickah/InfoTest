import os
import subprocess
import re
import random as rand
from signal import signal, SIGINT, SIGTERM
from sys import exit

def signalHandler(sig, frame):
    exit(0)

def pickRandomString():
    result = []
    alphabet = list("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789")
    rand.shuffle(alphabet)
    for _ in range(10):
        result.append(rand.choice(alphabet))
    return "".join(["{0}".format(k) for k in result])


def evaluate(ssid, solution, variables):
    stages = variables["stages"]
    solution = solution.strip()
    print(os.getcwd())
    if os.path.isfile("./{0}".format(solution)):
        solutionFile = "./{0}/solutions/{1}".format(variables["problem"].strip(), solution)
        os.rename("./{0}".format(solution), solutionFile)
        fileName = "{0}_{1}".format(pickRandomString(), variables["problem"].strip())
        compiled = "./{0}/{1}".format(variables["problem"].strip(), fileName)
        with open("{0}_eval.log".format(variables["user"].strip()), "w") as log:
            scoreTotal = 0
            process = subprocess.Popen(["gcc", "-o", compiled, solutionFile], stdout=log, stderr=log, universal_newlines=True)
            return_code = 0
            log.write("Code compiled! \n")
            while True:
                return_code = process.poll()
                if return_code is not None:
                    break
            if return_code == 0:
                with open(stages, "r") as stagesFile:
                    line = stagesFile.readline()
                    while line:
                        stage, score = [ k.strip() for k in line.split(" ") ]
                        folder = "./{0}/{1}".format(variables["problem"].strip(), stage)
                        os.chdir(folder)
                        run = subprocess.Popen(["../.{0}".format(compiled)], stdout=log, stderr=log, universal_newlines=True)
                        log.write("Stage {0}: File evaluated. Score: ".format(stage))
                        while True:
                            return_code = run.poll()
                            if return_code is not None:
                                break
                        with open("{0}.ok".format(variables["problem"].strip()), "r") as ok:
                            lines_ok = ok.readlines() 
                            ok.close()
                            lines_out = []
                            with open("{0}.out".format(variables["problem"].strip()), "r") as out:
                                lines_out = out.readlines()
                                out.close()
                            if lines_out == []:
                                log.write("No output read from file\n")
                            else:
                                if len(lines_out) == len(lines_ok):
                                    ok = True
                                    for i,line in enumerate(lines_ok):
                                        if line!=lines_out[i]: 
                                            ok = False
                                else: ok = False
                                if ok:
                                    log.write("{0}\n".format(score))
                                    scoreTotal = scoreTotal + int(score)
                            os.remove("{0}.out".format(variables["problem"].strip()))
                        os.chdir("../../")
                        line = stagesFile.readline()
            log.write("Total score obtinut: {0}\n".format(scoreTotal))
            os.remove(compiled + ".exe") 
            log.close()
            return return_code
    return 0


def interpretLine(ssid, line, variables):
    keywords = line.split(" ")
    if keywords[0] == "USER":
        variables["user"] = keywords[1]
    elif keywords[0] == "PROBLEM":
        variables["problem"] = keywords[1]
    elif keywords[0] == "DEFINE":
        match = re.fullmatch("<([\\w]+)>", keywords[1])
        if match and keywords[2]=="AS":
            matches = re.findall("<([\\w]+)>", keywords[3])
            if matches:
                for group in matches:
                    keywords[3] = keywords[3].replace("<{0}>".format(group), variables[group].strip())
                variables["defs"][match.group(1)] = keywords[3]
    elif keywords[0] == "EVAL":
        stageFile = os.getcwd() + "/"
        match = re.fullmatch("<([\\w]+)>", keywords[1])
        if match: what = variables["defs"][match.group(1)]
        else: what = variables["defs"]["solution"]
        groups = re.findall("<([\\w]+)>", keywords[2])
        if groups:
            for group in groups:
                keywords[2] = keywords[2].replace("<{0}>".format(group), variables[group].strip())
            variables["stages"] = keywords[2]
        os.rename(variables["problem"].strip()+".c", what.strip())
        return evaluate(ssid, what, variables)

def interpretEntry(ssid, variables):
    if os.path.isfile("{0}_entry.txt".format(ssid)):
        with open("{0}_entry.txt".format(ssid), "r") as entryFile:
            line = entryFile.readline()
            while line:
                print("[Evaluator] Interpreting line {0}".format(line.strip()))
                interpretLine(ssid, line, variables)
                line = entryFile.readline()
            entryFile.close()

def main():
    signal(SIGINT, signalHandler)
    signal(SIGTERM, signalHandler)

    ssid = pickRandomString()
    while True:
        if os.path.isfile("entry.txt"):
            print(os.path.curdir)
            os.rename("entry.txt", "{0}_entry.txt".format(ssid))
            print("[Evaluator] Interpreting entry file with session id {0}".format(ssid))
            interpretEntry(ssid, {"defs":{},"stages":""})
        ssid = pickRandomString()

if __name__ == "__main__":
    main()
