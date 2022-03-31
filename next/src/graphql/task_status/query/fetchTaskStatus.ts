import { gql } from '@apollo/client';
import type { TaskStatus } from 'models/task_status';

export const FETCH_TASK_STATUSES_QUERY = gql`
  query FetchTaskStatuses {
    task_statuses {
      id
      status
    }
  }
`;

export interface TaskStatusData {
  task_statuses: TaskStatus[];
}
