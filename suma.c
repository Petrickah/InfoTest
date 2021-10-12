#include <stdio.h>

int main() {
    FILE* in = fopen("suma.in", "r");
    FILE* out = fopen("suma.out", "w");

    if(in != NULL) {
        int s=0, n, x, i;
        fscanf(in, "%d", &n);
        for(i=0; i<n; i++) {
            fscanf(in, "%d", &x);
            s=s+x;
        }
        if(out!=NULL) fprintf(out, "%d", s);
    }
    fclose(in); fclose(out);
    return 0;
}