import java.util.Scanner;

class Solution {
    int res = 0;

    public int splitArray(int[] nums, int k) {
        int max = 0;
        int min = Integer.MIN_VALUE;
        for (int i : nums) {
            max += i;
            min = Math.max(min, i);
        }

        int mid = min + (max - min) / 2;
        binarySearch(nums, k, min, mid, max);
        return res;
    }

    public void binarySearch(int[] nums, int k, int start, int mid, int end) {
        if (start > end) return;
        mid = start + (end - start) / 2;
        if (isFeasible(nums, k, mid) <= k) {
            end = mid - 1;
            res = mid;
            binarySearch(nums, k, start, mid, end);
        } else {
            start = mid + 1;
            binarySearch(nums, k, start, mid, end);
        }
    }

    public int isFeasible(int[] nums, int k, int n) {
        int c = 0, total = 0;
        for (int i : nums) {
            if (total + i <= n) total += i;
            else {
                c++;
                total = i;
            }
        }
        return c + 1;
    }

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);

        // Input: array length and elements
        System.out.println("Enter the length of the array:");
        int n = sc.nextInt();
        int[] nums = new int[n];
        System.out.println("Enter the elements of the array:");
        for (int i = 0; i < n; i++) {
            nums[i] = sc.nextInt();
        }

        // Input: value of k
        System.out.println("Enter the value of k:");
        int k = sc.nextInt();

        // Create an instance of Solution and call the method
        Solution solution = new Solution();
        int result = solution.splitArray(nums, k);

        // Output the result
        System.out.println("The minimum largest sum among the subarrays is: " + result);

        sc.close();
    }
}
